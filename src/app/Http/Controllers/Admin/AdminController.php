<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * 管理画面の表示と検索
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Contact::query()->with('category');

        // 共通の検索ロジックを適用
        $query = $this->applySearchFilters($query, $request);

        // 検索条件を維持したままページネーションを実行
        $contacts = $query->paginate(7)->appends($request->all());

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * CSVエクスポート
     */
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::query()->with('category');
        $query = $this->applySearchFilters($query, $request);

        $contacts = $query->get();

        $filename = "contacts_" . date('YmdHis') . ".csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // ヘッダー行
            $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];
            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);
            fputcsv($file, $csvHeader);

            // データ行
            foreach ($contacts as $contact) {
                $gender = ($contact->gender == 1) ? '男性' : (($contact->gender == 2) ? '女性' : 'その他');
                $row = [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->detail,
                ];
                mb_convert_variables('SJIS-win', 'UTF-8', $row);
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * 削除処理
     */
    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);
        if ($contact) {
            $contact->delete();
        }
        return redirect()->route('admin.index');
    }

    /**
     * 検索フィルタの適用（フルネーム・スペースなし対応版）
     */
    private function applySearchFilters($query, Request $request)
    {
        // 1. 名前・メール検索
        if ($request->filled('first_last_name')) {
            $keyword = $request->first_last_name;

            // スペースを除去したキーワード（「山田花子」検索用）
            $rawKeyword = str_replace([' ', '　'], '', $keyword);

            // スペースで分割したキーワード（「山田 花子」検索用）
            $keywords = preg_split('/[\s　]+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY);

            $query->where(function ($q) use ($keyword, $keywords, $rawKeyword) {
                // ① メールアドレス一致
                $q->where('email', 'like', "%{$keyword}%")
                    // ② 姓と名を結合して部分一致（スペースなしフルネーム対応）
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$rawKeyword}%"])
                    // ③ 姓と名を個別にAND検索（スペースありフルネーム対応）
                    ->orWhere(function ($inner) use ($keywords) {
                        foreach ($keywords as $word) {
                            $inner->where(function ($sub) use ($word) {
                                $sub->where('last_name', 'like', "%{$word}%")
                                    ->orWhere('first_name', 'like', "%{$word}%");
                            });
                        }
                    });
            });
        }

        // 2. 性別検索 (0は「全て」を想定)
        if ($request->filled('gender') && $request->gender != 0) {
            $query->where('gender', $request->gender);
        }

        // 3. カテゴリー検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }
}
