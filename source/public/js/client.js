/**
 * AJAX long-polling
 *
 * 1. sends a request to the server (without a timestamp parameter)
 * 2. waits for an answer from server.php (which can take forever)
 * 3. if server.php responds (whenever), put data_from_file into #response
 * 4. and call the function again
 *
 * @param timestamp
 */
function getContent(timestamp)
{
    var senderId = $("#sender").val();
    var recieverId = $("#users").val();
    var queryString = {'timestamp' : timestamp,'sender':senderId , 'reciever':recieverId};
    queryString = JSON.stringify(queryString);
    $.ajax(
        {
            type: 'GET',
            url: window.location.origin+'/getLatestMsg?data='+queryString,
            success: function(data){
                $("#chat").empty();
                var data = JSON.parse(data);
                for(i=0;i<data.chat.length;i++){
                    $("#chat").append(data.chat[i]+'\n');    
                }
            },
            complete: function() {
                window.setTimeout(getContent, 2000);
            }
        }
    );
}

// initialize jQuery
$(function() {
    getContent();
    $("#send").click(function(e){
        e.preventDefault();
        var message = $("#text").val();
        $("#text").val('');
        var recieverId = $("#users").val();
        if(message == ""){
            alert("please enter your message you want to send");
        }else{
            var senderId = $("#sender").val();
            var data = JSON.stringify({"message":message,"sender":senderId,"reciever":recieverId})
            $.ajax(
                {
                    type: 'GET',
                    url: window.location.origin+'/sendMsg?data='+data,
                    success: function(data){
                        $("#chat").empty();
                        var messages = JSON.parse(data);
                        for(i=0;i<messages.length;i++){
                            $("#chat").append(messages[i]+'\n');    
                        }
                    },
                    error: function(error){
                    }
                }
            );
        }
    });

    $("#users").change(function(e){
            var senderId = $("#sender").val();
            var recieverId = $("#users").val();
            var data = JSON.stringify({"sender":senderId,"reciever":recieverId})
            $.ajax(
                {
                    type: 'GET',
                    url: window.location.origin+'/getChat?data='+data,
                    success: function(data){
                        $("#chat").empty();
                        var messages = JSON.parse(data);
                        for(i=0;i<messages.length;i++){
                            $("#chat").append(messages[i]+'\n');    
                        }
                    },
                    error: function(error){
                        console.log(error);
                    }
                }
            );
    })
});