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
  document.getElementById('assign_book_id').value = bookId;
  document.getElementById('article-list').innerHTML = '';

  // Fetch book title
  fetch('get_book_title.php?book_id=' + bookId)
    .then(res => res.json())
    .then(data => {
      document.getElementById('assign-modal-title').textContent = `Assign Articles to “${data.title}”`;
    });

  // Fetch assigned articles
  fetch('get_assigned_articles.php?book_id=' + bookId)
    .then(res => res.json())
    .then(data => {
      let html = '';
      data.forEach(article => {
        html += `<label><input type="checkbox" name="article_ids[]" value="${article.key_articles}" checked> ${article.title}</label><br>`;
      });
      document.getElementById('article-list').innerHTML = html;
      document.getElementById('assign-modal').style.display = 'block';
    });
}



function closeAssignModal() {
  document.getElementById('assign-modal').style.display = 'none';
}

function filterArticles() {
  const query = document.getElementById('article_search').value;
  const bookId = document.getElementById('assign_book_id').value;

  if (query.length < 4) return;

  // Clear previous search results (but keep already assigned ones)
  const assignedLabels = Array.from(document.querySelectorAll('#article-list input:checked'))
  .map(input => input.closest('label').outerHTML);

  fetch('search_articles.php?q=' + encodeURIComponent(query) + '&book_id=' + bookId)
    .then(res => res.json())
    .then(data => {
      let html = assignedLabels.join(''); // preserve checked items
      data.forEach(article => {
        html += `<p><label><input type="checkbox" name="article_ids[]" value="${article.key_articles}"> ${article.title}</label></p>`;
      });
      document.getElementById('article-list').innerHTML = html;
    });
}





// Article-Author Assignment
function openAuthorModal(articleId) {
  document.getElementById('author_article_id').value = articleId;
  fetch('get_authors.php?article_id=' + articleId)
    .then(res => res.json())
    .then(data => {
      let html = '';
      data.authors.forEach(author => {
        const checked = data.assigned.includes(author.key_authors) ? 'checked' : '';
        html += `<label><input type="checkbox" name="author_ids[]" value="${author.key_authors}" ${checked}> ${author.name}</label><br>`;
      });
      document.getElementById('author-list').innerHTML = html;
      document.getElementById('author-modal').style.display = 'block';
    });
}

function closeAuthorModal() {
  document.getElementById('author-modal').style.display = 'none';
}

