
fetch('admin update product.php')
 .then(response => response.json())
 .then(data => {
    const small = document.getElementById('pSmallQty');
    const medium = document.getElementById('pMedQty');
    const large = document.getElementById('pLargeQty');
    const totQty = small+medium+large;

    if (totQty === 0) {
        quantityMessageElement.textContent = 'This product is out of stock.';
        quantityMessageElement.style.color = 'red';
    } else {
        quantityMessageElement.textContent = '';
    }
    });
    if (data.inStock === false) {
      document.querySelector('.product-info').innerHTML += '<span>Out of Stock</span>';
    }
  });
