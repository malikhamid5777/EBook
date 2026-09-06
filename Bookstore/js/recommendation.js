document.addEventListener('DOMContentLoaded', () => {
    const recommendationsGrid = document.querySelector('.recommendations-grid');

    if (!recommendationsGrid) return;

    recommendationsGrid.addEventListener('click', async (event) => {
        const removeBtn = event.target.closest('.btn-remove');
        if (!removeBtn) return;

        const bookElement = removeBtn.closest('.recommended-book');
        const isbn = bookElement?.dataset?.isbn;
        const genre = new URLSearchParams(window.location.search).get('genre');

        if (!isbn || !genre) {
            console.error('Missing ISBN or genre data');
            return;
        }

        // Visual feedback
        const originalHTML = removeBtn.innerHTML;
        removeBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Removing...`;
        removeBtn.disabled = true;

        try {
            const response = await fetch(`/Bookstore/remove_recommendation.php?isbn=${encodeURIComponent(isbn)}&genre=${encodeURIComponent(genre)}`, {
                headers: { 'Accept': 'application/json' }
            });

            // Handle HTTP errors
            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Server error: ${response.status} - ${errorText}`);
            }

            const data = await response.json();
            console.log('Removal Response:', data);

            if (data.success) {
                // Animate removal
                bookElement.classList.add('removing');

                if (data.newBook) {
                    // Delay replacement for smooth transition
                    setTimeout(() => {
                        bookElement.outerHTML = createBookElement(data.newBook);
                    }, 300);
                } else {
                    // Remove element if no replacement
                    setTimeout(() => {
                        bookElement.remove();
                        if (!document.querySelector('.recommended-book')) {
                            showEmptyRecommendations();
                        }
                    }, 500);
                }
            } else {
                throw new Error(data.message || 'Removal failed');
            }

        } catch (error) {
            console.error('Removal Error:', error);
            alert(`Error: ${error.message}`);
            // Restore button state
            removeBtn.innerHTML = originalHTML;
            removeBtn.disabled = false;
        }
    });
});

// Safe HTML generation
const createBookElement = (book) => {
    const escape = (str) => str
        ? str.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
        : '';

    return `
    <div class="recommended-book" data-isbn="${escape(book?.ISBN)}">
        <div class="rec-book-image">
            <img src="/Bookstore/assets/images/books/${escape(book?.image)}" 
                 alt="${escape(book?.book_title)}">
        </div>
        <div class="rec-book-details">
            <h4>${escape(book?.book_title)}</h4>
            <span class="rec-genre">${escape(book?.genre)}</span>
            <div class="rec-book-actions">
                <form method="post" action="/Bookstore/add_to_cart.php" class="inline-form">
                    <input type="hidden" name="isbn" value="${escape(book?.ISBN)}">
                    <button type="submit" class="btn-cart-sm">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
                <button class="btn-remove">
                    <i class="fas fa-times"></i> Remove
                </button>
            </div>
        </div>
    </div>`;
};

const showEmptyRecommendations = () => {
    const container = document.querySelector('.recommendations-grid');
    if (container) {
        container.innerHTML = `
            <div class="no-recommendations">
                <i class="fas fa-book-open"></i>
                <p>No more recommendations in this genre!</p>
            </div>
        `;
    }
};

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    .recommended-book {
        transition: all 0.3s ease;
        opacity: 1;
    }
    
    .recommended-book.removing {
        animation: fadeOutSlide 0.5s ease forwards;
    }
    
    @keyframes fadeOutSlide {
        0% { opacity: 1; transform: translateX(0); }
        100% { opacity: 0; transform: translateX(-100%); }
    }
    
    .no-recommendations {
        text-align: center;
        padding: 2rem;
        color: #666;
    }
`;
document.head.appendChild(style);