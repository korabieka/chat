/**
 * AJAX long-polling
 *
 * 1. sends a request to the server (without a timestamp parameter)
 * 2. waits for an answer from server
 * 3. if server respond, put the content in the html
 * 4. and call the function again after 2 seconds
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
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: window.location.origin+'/getLatestMsg',
            data: {'queryString':queryString},
            success: function(data){
                appendContent(data);
            },
            complete: function() {
                window.setTimeout(getContent, 2000);
            }
        }
    );
}

/**
 * This function for appending the chat in the html
 *
 * @param data
 */
function appendContent(data)
{
    $("#chat").empty();
    console.log(data);
    var data = JSON.parse(data);
    for(i=0;i<data.chat.length;i++){
        $("#chat").append(data.chat[i]+'\n');    
    }
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
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: window.location.origin+'/sendMsg',
                    data: {'data':data},
                    success: function(data){
                        appendContent(data);
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
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    url: window.location.origin+'/getChat',
                    data: {'data':data},
                    success: function(data){
                        appendContent(data);
                    }
                }
            );
    });
});