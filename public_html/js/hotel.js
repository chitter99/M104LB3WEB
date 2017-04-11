var hotel = (function() {
    return new function() {
        this.book = function(room) {
            window.location.href = "book.php?room=" + room;
        };
    };
})();
