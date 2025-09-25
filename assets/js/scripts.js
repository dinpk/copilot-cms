function openModal() {
  document.getElementById('modal-title').innerText = "Add";
  document.getElementById('modal-form').action = "add.php";
  document.querySelectorAll('#modal-form input, #modal-form textarea').forEach(el => el.value = '');
  document.getElementById('modal').style.display = "block";
}

function editItem(id, endpoint, fields) {
  fetch(endpoint + '?id=' + id)
    .then(res => res.json())
    .then(data => {
      document.getElementById('modal-title').innerText = "Edit";
      document.getElementById('modal-form').action = "edit.php?id=" + id;
      fields.forEach(key => {
        if (document.getElementById(key)) {
          document.getElementById(key).value = data[key];
        }
      });
      document.getElementById('modal').style.display = "block";
    });
	document.getElementById("parent_id").value = data.parent_id;
}

function closeModal() {
  document.getElementById('modal').style.display = "none";
}


// Book-Article Assignment

function openAssignModal(bookId) {
  fetch(`assign_articles_modal.php?book=${bookId}`)
    .then(res => res.text())
    .then(html => {
      document.getElementById('assign-modal').innerHTML = html;
      document.getElementById('assign-modal').style.display = 'block';
    });
}

function saveAssignments() {
  const form = document.getElementById('assign-form');
  fetch('assign_articles_save.php', {
    method: 'POST',
    body: new FormData(form)
  }).then(() => location.reload());
}

function filterArticles() {
  const query = document.getElementById('article-search').value.toLowerCase();
  document.querySelectorAll('.article-item').forEach(item => {
    item.style.display = item.textContent.toLowerCase().includes(query) ? 'block' : 'none';
  });
}

function searchArticles(bookId) {
  const query = document.getElementById('article-search').value;
  fetch(`search_articles.php?book=${bookId}&q=${encodeURIComponent(query)}`)
    .then(res => res.text())
    .then(html => {
      document.getElementById('article-list').innerHTML = html;
    });
}
