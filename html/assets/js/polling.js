data_shown = []



function get_index(new_child, father){
    var index = -1;
    for(var child in father){
        index += 1;
        if(child == new_child){
            return index;
        }
    }
    return -1;
}

function show_process()
{
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "/challenges/progress",
            dataType: "json",
            success: function(msg) {
                var size = msg.length
                var sound_flag = false;
                for(var i in msg){
                    var index = get_index(i, data_shown);
                    if (index == -1){
                        sound_flag = true;
                        // show
                        var username = msg[i]['username'];
                        var challenge_name = msg[i]['challenge_name'];
                        var submit_time = msg[i]['submit_time'];
                        var content = challenge_name + ' is solved by ' + username + '<br>' + submit_time;
                        // show the alert dialog
                        $(function(){
                            PNotify.prototype.options.styling = "bootstrap3";
                            new PNotify({
                                title: "New Progress!",
                                type: 'info',
                                text: content,
                                icon: false,
                                delay: 2000 * size,
                                buttons: {
                                    closer: false,
                                },
                            });
                        });
                        // add to shown
                        data_shown += i;
                    }
                }
                // play sound only once
                if (sound_flag){
                    $('#chatAudio')[0].play()
                }
            }
        });
    });
}
setInterval('show_process()', 60 * 1000);
show_process()