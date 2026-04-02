function openModal(button) {
    // ボタンのdata属性から値を取得
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const gender = button.getAttribute('data-gender');
    const email = button.getAttribute('data-email');
    const tel = button.getAttribute('data-tel');
    const address = button.getAttribute('data-address');
    const building = button.getAttribute('data-building');
    const category = button.getAttribute('data-category');
    const detail = button.getAttribute('data-detail');

    // モーダルの各要素に値をセット
    document.getElementById('modal-id').value = id;
    document.getElementById('modal-name').innerText = name;
    document.getElementById('modal-gender').innerText = gender;
    document.getElementById('modal-email').innerText = email;
    document.getElementById('modal-tel').innerText = tel;
    document.getElementById('modal-address').innerText = address;
    document.getElementById('modal-building').innerText = building || '';
    document.getElementById('modal-category').innerText = category;
    document.getElementById('modal-detail').innerText = detail;

    // モーダルを表示
    document.getElementById('detailModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}

// 枠外をクリックしても閉じるように設定
window.onclick = function (event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) {
        closeModal();
    }
}
