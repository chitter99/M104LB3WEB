var hotel = new (function() {
    this.redirectToBooking = function(t, rf, rt) {
        window.location.href = "book.php?type=" + t + "&from=" + rf + "&to=" + rt;
    };
});
