
$.ajax({
    statusCode: {
      404: function() {
        window.location.href = "http://example.com/404.html";
      }
    }
});


document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".bank-info-Btn")?.addEventListener("click", function () {
        // info penceresine git
        window.location.href = "info.php";
    });

    document.querySelector(".bank-credit-Btn")?.addEventListener("click", function () {
        // krediler penceresine git
        window.location.href = "credit.php";
    });
});



