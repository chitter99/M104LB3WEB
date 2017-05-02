var hotel = new (function() {
    this.redirectToBooking = function(t, rf, rt) {
        window.location.href = "book.php?type=" + t + "&from=" + rf + "&to=" + rt;
    };
    this.storRent = function(id) {
        window.location.href = "user.php?id=" + id + "&action=cancel";
    };
});
