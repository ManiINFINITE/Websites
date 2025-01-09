document.addEventListener('DOMContentLoaded', function() {
    const addNewBookButton = document.getElementById('addNewBookButton');
    const addBookSection = document.getElementById('addBookSection');
    const overlay = document.getElementById('overlay');
    const closeAddBookButton = document.getElementById('closeAddBookButton');
    const profile = document.getElementById("profile");
    const profileInfo = document.getElementById("profile-info");
    const searchForm = document.getElementById('search-form');
    const submitSearchButton = document.getElementById('submit-search');
    let profileIsDown = false;
    const userRole = addBookSection.getAttribute('data-user-role');

    if (userRole === 'staff') {
        addNewBookButton.style.display = "block";
        addNewBookButton.addEventListener('click', function() {
            overlay.style.display = 'block';
            addBookSection.style.display = 'flex';
        });
    
        closeAddBookButton.addEventListener('click', function() {
            overlay.style.display = 'none';
            addBookSection.style.display = 'none';
        });
    
        overlay.addEventListener('click', function() {
            overlay.style.display = 'none';
            addBookSection.style.display = 'none';
        });
    } else {
        addNewBookButton.style.display = "none";
        addBookSection.style.display = 'none';
    }

    profile.addEventListener("click", function() {
        profileInfo.style.transform = profileIsDown ? "translateY(-250px)" : "translateY(100px)";
        profileIsDown = !profileIsDown;
    });

    let currentPage = 1;

    function fetchBooks(page, search = '') {
        fetch(`homepage.php?page=${page}&ajax=1&search=${search}`)
            .then(response => response.json())
            .then(data => {
                const bookList = document.querySelector('.book-list');
                bookList.innerHTML = '';
    
                data.books.forEach(book => {
                    const bookElement = document.createElement('div');
                    bookElement.classList.add('book');
                    bookElement.innerHTML = `
                        <a href="bookDetails.php?id=${book.id}" target="_blank">
                            <img src="${book.cover}" alt="${book.title} cover">
                            <h3>${book.title}</h3>
                            <p>${book.author}</p>
                        </a>
                        <button onclick="addToFavorites(${book.id})">
                            <i class="fas fa-heart"></i>
                        </button>
                    `;
                    bookList.appendChild(bookElement);
                });
    
                // Call setupPagination regardless of user role
                setupPagination(data.total_books, data.books_per_page, data.current_page);
            })
            .catch(error => console.error('Error fetching books:', error));
    }

    function setupPagination(totalBooks, booksPerPage, currentPage) {
        console.log("Total Books:", totalBooks); // Log total books
        console.log("Books Per Page:", booksPerPage); // Log books per page
        console.log("Current Page:", currentPage); // Log current page
    
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = ''; // Clear existing buttons
        const totalPages = Math.ceil(totalBooks / booksPerPage);
    
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.classList.add('page-button');
            if (i === currentPage) pageButton.classList.add('active');
            pageButton.addEventListener('click', function() {
                fetchBooks(i, searchForm.elements.search.value);
            });
            pagination.appendChild(pageButton);
        }
    }

    fetchBooks(currentPage);

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetchBooks(1, searchForm.elements.search.value);
    });
});

window.addToFavorites = function(bookId) {
    fetch('addToFavorites.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ book_id: bookId })
    })
    .then(response => response.json())
    .then(data => {

        if (data.status === 'success') {
            alert('Book added to favorites');
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error adding book to favorites:', error));
};

