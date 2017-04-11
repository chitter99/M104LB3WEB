var hotel = new (function() {
    this.book = function(t) {
        window.location.href = "book.php?type=" + t;
    };
});
