// To create an anonymous webchat for everyone who visits the site, do the following:
// 1.  replace nameInput variable value with the following - $('#nameInput').val()
// 2.  Add this HTML line inside chat-content div element.
// <div class='chat-toolbar'><input type='text' id='nameInput' placeholder='Enter a username...'></div>

// CREATE A REFERENCE TO FIREBASE
var messagesRef = new Firebase('https://kurikutsu.firebaseio.com/');

// REGISTER DOM ELEMENTS
var messageField = $('#messageInput');

var nameField = "<?= $user['username'];?>";
var messageList = $('#messages');

// LISTEN FOR KEYPRESS EVENT
messageField.keypress(function (e) {
    if (e.keyCode == 13) {
        //FIELD VALUES
        var username = nameField;
        var message = messageField.val();

        //SAVE DATA TO FIREBASE AND EMPTY FIELD
        messagesRef.push({name: username, text: message});
        messageField.val('');
    }
});

// Add a callback that is triggered for each chat message.
messagesRef.limitToLast(10).on('child_added', function (snapshot) {
    //GET DATA
    var data = snapshot.val();
    var username = data.name || "anonymous";
    var message = data.text;

    //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
    var messageElement = $("<li class='firechat-list-item'>");
    var nameElement = $("<strong class='firechat-username'></strong>");
    nameElement.text(username);
    messageElement.text(message).prepend(nameElement);

    //ADD MESSAGE
    messageList.append(messageElement)

    //SCROLL TO BOTTOM OF MESSAGE LIST
    messageList[0].scrollTop = messageList[0].scrollHeight;
});

$('.firechat-header').click(function () {
    if($('.firechat-container').hasClass("active")){
        $('.firechat-container').removeClass("active");
    }else{
        $('.firechat-container').addClass("active");
    }
});

// Create free space for user admin panel
$(".user-container-toggle").click(function(){
    if($(".user-admin-block").hasClass("show")){
        $(".user-admin-block").removeClass("show");
        $(".main-page-block").removeClass("move");
        $(".user-container-toggle.show").css("display","inline-block");
    }else{
        $(".user-admin-block").addClass("show");
        $(".main-page-block").addClass("move");
        $(".user-container-toggle.show").css("display","none");
    }
});