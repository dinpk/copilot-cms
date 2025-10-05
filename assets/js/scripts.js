



// Attach form listener only once
document.addEventListener('DOMContentLoaded', function () {

	const modalForm = document.querySelector('#modal-form');
	if (modalForm) {
		document.getElementById('modal-form').addEventListener('submit', function(e) {
		  e.preventDefault();

		  const form = e.target;
		  const formData = new FormData(form);

		  fetch(form.action, {
			method: 'POST',
			body: formData
		  })
		  .then(response => response.text())
		  .then(data => {
			if (data.includes('❌')) {
			  alert(data);
			} else {
			  window.location.href = 'list.php'; // or close modal and refresh list
			}
		  })
		  .catch(error => {
			alert('❌ Submission failed.');
			console.error(error);
		  });
		});	
	}
	

  const imageForm = document.querySelector('#image-modal form');
  if (imageForm) {
    imageForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const data = new FormData(imageForm);
      const productId = document.getElementById('image_key_product').value;

      fetch('assign_image.php', {
        method: 'POST',
        body: data
      })
      .then(() => fetch('get_images.php?key_product=' + productId))
      .then(res => res.text())
      .then(html => {
        document.getElementById('image-list').innerHTML = html;
        imageForm.reset();
      });
    });
  }
});







function openModal() {
  document.getElementById('modal-title').innerText = "Add";
  document.getElementById('modal-form').action = "add.php";
  document.querySelectorAll('#modal-form form > input, #modal-form textarea').forEach(el => el.value = '');
  document.getElementById('modal').style.display = "block";
}

function editItem(id, endpoint, fields) {
  fetch(endpoint + '?id=' + id)
    .then(res => res.json())
    .then(data => {
      document.getElementById('modal-title').innerText = "Edit";
      document.getElementById('modal-form').action = "edit.php?id=" + id;

      fields.forEach(key => {
        const el = document.getElementById(key);
        if (el) el.value = data[key];
      });

      // Set category_type dropdown
      if (data.category_type && document.getElementById('category_type')) {
        document.getElementById('category_type').value = data.category_type;
      }

      // Set content_type dropdown
      if (data.content_type && document.getElementById('content_type')) {
        document.getElementById('content_type').value = data.content_type;
      }

		// Selected categories (articles, books, photo, youtube)
		if (data.categories && Array.isArray(data.categories)) {
			
		  document.querySelectorAll('input[name="categories[]"]').forEach(cb => {
			cb.checked = data.categories.includes(parseInt(cb.value));
		  });
		}


      // Set status checkbox
      if (document.getElementById('status')) {
        document.getElementById('status').checked = (data.status === 'on');
      }

      // Optional: Set parent_id if used
      if (document.getElementById('parent_id') && data.parent_id !== undefined) {
        document.getElementById('parent_id').value = data.parent_id;
      }

      document.getElementById('modal').style.display = "block";
    });
}

function closeModal() {
  document.getElementById('modal-form').reset();
  document.getElementById('modal').style.display = "none";
}



// Open the image modal and load existing images
function openImageModal(productId) {
  document.getElementById('image_key_product').value = productId;

  fetch('get_images.php?key_product=' + productId)
    .then(res => res.text())
    .then(html => {
      document.getElementById('image-list').innerHTML = html;
      document.getElementById('image-modal').style.display = 'block';
    });
}

function closeImageModal() {
  document.getElementById('image-modal').style.display = 'none';
}

function deleteImage(imageId, productId) {
  fetch('delete_image.php?id=' + imageId + '&key_product=' + productId)
    .then(res => res.text())
    .then(html => {
      document.getElementById('image-list').innerHTML = html;
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
console.log('search_articles.php?q=' + encodeURIComponent(query) + '&book_id=' + bookId);
  fetch('search_articles.php?q=' + encodeURIComponent(query) + '&book_id=' + bookId)
    .then(res => res.json())
    .then(data => {
		console.log(data);
      let html = assignedLabels.join(''); // preserve checked items
      data.forEach(article => {
        html += `<p><label><input type="checkbox" name="article_ids[]" value="${article.key_articles}"> ${article.title}</label></p>`;
      });
      document.getElementById('article-list').innerHTML = html;
    });
}


// Books sell

function openSellModal() {
  document.getElementById('sell-modal-title').innerText = "Edit Sell Info";
  document.getElementById('sell-form').reset();
  document.getElementById('key_books').value = '';
  document.getElementById('sell-modal').style.display = 'block';
}

function closeSellModal() {
  document.getElementById('sell-modal').style.display = 'none';
}

function editSellItem(id, endpoint, fields) {
  fetch(endpoint + '?id=' + id)
    .then(response => response.json())
    .then(data => {
      document.getElementById('sell-modal-title').innerText = "Edit Sell Info";
      document.getElementById('key_books').value = id;
      fields.forEach(field => {
        if (document.getElementById(field)) {
          document.getElementById(field).value = data[field] || '';
        }
      });
      document.getElementById('sell-modal').style.display = 'block';
    });
}

function loadPriceHistory(id) {
  fetch('get_price_history.php?id=' + id)
    .then(res => res.text())
    .then(html => {
      openInfoModal("Price History", html);
    });
}



function openInfoModal(title, contentHtml) {
  document.getElementById('info-modal-title').innerText = title;
  document.getElementById('info-modal-content').innerHTML = contentHtml;
  document.getElementById('info-modal').style.display = 'block';
}

function closeInfoModal() {
  document.getElementById('info-modal').style.display = 'none';
}



function setCleanURL(title) {
  const urlInput = document.querySelector('#url');
  if (!urlInput.value) {
    const slug = title
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .replace(/^-|-$/g, '');
	  console.log(slug);
    urlInput.value = slug;
  }
}
