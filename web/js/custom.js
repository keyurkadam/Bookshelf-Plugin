
$(document).ready(function() {
    
    var favoriteBooks = getFavoriteBooks();

    addItemToCart();
    

    $('.tm-wishlist').each(function() {
        var bookId = $(this).attr('data-id');
        if (favoriteBooks.includes(bookId)) {
            $(this).addClass('favorite-book');
        } 
    
    });
    
       

    $('.tm-wishlist').on('click', function() {
        var favoriteBooks = getFavoriteBooks();
        var bookId = $(this).attr('data-id'); 

        if (favoriteBooks.includes(bookId)) {
            favoriteBooks.splice(favoriteBooks.indexOf(bookId), 1);
            
            $(this).removeClass('favorite-book');
        } else {
            favoriteBooks.push(bookId);
            $(this).addClass('favorite-book');
            
        }

        setFavoriteBooks(favoriteBooks);
        addItemToCart();
    });

    $('#cart').on('click', function(){
        if (document.querySelector('.cart-modal-overlay').style.transform === 'translateX(-200%)') {
            
            $('.cart-modal-overlay').css('transform','translateX(0)');
        }
        else if(document.querySelector('.cart-modal-overlay').style.transform === 'translateX(0)')
        {
            
            $('.cart-modal-overlay').css('transform','translateX(-200%)');
        }
        else
        {
            $('.cart-modal-overlay').css('transform','translateX(0)');
        }
        
    });

    $('#close-btn').on('click', function() {
        $('.cart-modal-overlay').css('transform','translateX(-200%)');
      });

      
    function updateFavoriteBooksNumber()
    {
        var favoriteBooks = getFavoriteBooks();
        $('.cart-quantity').html(favoriteBooks.length);   

    }

  
    function getFavoriteBooks() {
        var favoriteBooks = $.cookie('favoriteBooks');

        if (favoriteBooks) {
            console.log(JSON.parse(favoriteBooks));
            return JSON.parse(favoriteBooks);
        } else {
            return [];
        }
    }

    function setFavoriteBooks(favoriteBooks) {
        $.cookie('favoriteBooks', JSON.stringify(favoriteBooks), { expires: 365, path: '/' });
    }

    function addItemToCart () {
       
        
        var favoriteBooks = getFavoriteBooks();
        
        $(".product-rows").empty();
        for (var i = 0; i < favoriteBooks.length; i++){
            var productRow = document.createElement('div');
            productRow.classList.add('product-row');
            var productRows = document.getElementsByClassName('product-rows')[0];
            var cartImage = document.getElementsByClassName('cart-image');
            var bookTitle = $('.book-title-'+favoriteBooks[i]).html();
            
            var cartRowItems = `
            <div class="product-row">
                  <img class="cart-image" src="img/image-01.jpg" alt="">
                  <span class ="cart-price">${bookTitle}</span>   
                  </div>`
            productRow.innerHTML = cartRowItems;
            productRows.append(productRow);
            // alert(bookTitle);
        }
        updateFavoriteBooksNumber();
      }
});