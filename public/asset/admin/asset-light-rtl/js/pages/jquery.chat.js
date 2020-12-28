! function(s) {

    var user_img = $('.user-img img');
    var user_name = $('.user_name');
    "use strict";
    var t = function() { this.$body = s("body"), this.$chatInput = s(".chat-input"), this.$chatList = s(".conversation-list"), this.$chatSendBtn = s(".chat-send") };
    t.prototype.save = function() {
        var t = this.$chatInput.val(),
            i = moment().format("YYYY-MM-DD HH:mm:ss");
        "" == t ? (sweetAlert("Oops...", "You forgot to enter your chat message", "error"), this.$chatInput.focus()) : (s('<li class="clearfix odd"><div class="chat-avatar"><img src="' + user_img.attr('src') + '" alt="admin"></div><div class="conversation-text"><div class="ctext-wrap"><i>' + user_name.html() + '</i><p>' + t + "</p><div class=class='text-muted mt-2'>" + i + "</div></div></div></li>").appendTo(".conversation-list"), this.$chatInput.val(""), this.$chatInput.focus(), this.$chatList.scrollTo("100%", "100%", { easing: "swing" }))
    }, t.prototype.init = function() {
        var i = this;
        i.$chatInput.keypress(function(t) { if (13 == t.which) return i.save(), !1 }), i.$chatSendBtn.click(function(t) {
            setTimeout(() => {
                return i.save(), !1
            }, 1000);
        })
    }, s.ChatApp = new t, s.ChatApp.Constructor = t
}(window.jQuery),
function(t) {
    "use strict";
    window.jQuery.ChatApp.init()
}();