/*
 * 获取元素对象
 * @param {Object} id
 */
function getE(id){
    return document.getElementById(id);
}
/**
 * 使元素铺满全屏
 * @param {Object} e
 */
function fillScreen(e){
    //获取可视区域尺寸
    var vH = document.documentElement.clientHeight;
    var vW = document.documentElement.clientWidth;
    //设置铺满全屏
    e.style.height = vH + "px";
    e.style.width = vW + "px";
}
/**
 * 元素在可视区域中居中
 * @param {Object} e
 */
function toCenter(e){
    //获取可视区域尺寸
    var vH = document.documentElement.clientHeight;
    var vW = document.documentElement.clientWidth;
    //获取元素尺寸
    var eH = e.offsetHeight;
    var eW = e.offsetWidth;
    //调整居中
    e.style.top = (vH-eH)/2 + "px";
    e.style.left = (vW-eW)/2 + "px";
}
/**
 * 显示元素
 * @param {Object} e
 */
function showE(e){
    e.style.display = "block";
}
/**
 * 隐藏元素
 * @param {Object} e
 */
function hideE(e){
    e.style.display = "none";
}

function getChallengeDetail(challengeID) {

    var container = document.getElementById("alert-dialog")
    container.innerHTML = "";
    
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("GET","/challenges/detail/"+challengeID, true); // true 异步请求
    xmlhttp.send();

    var result = "";
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            result = xmlhttp.responseText;
            eval("var data="+result); // 竟然这样解析 json , 三观颠覆


            var title_element = document.createElement("div");
            title_element.setAttribute("id", "alert-dialog-title")
            var title = "<h2>"+data["name"]+"</h2>"
            title_element.innerHTML = title; 

            var content_element = document.createElement("div");
            content_element.setAttribute("id", "alert-dialog-content")
            var content = "<p>"+data["description"]+"</p>";
            content += "<p>"+data["score"]+"</p>";
            content += "<p>"+data["type"]+"</p>";
            content += "<p>"+data["online_time"]+"</p>";
            content += "<p>"+data["get_challenge_solved_times"]+"</p>";
            content += "<p>"+data["get_challenge_submit_times"]+"</p>";
            content += "<p>"+data["resource"]+"</p>";
            content += "<p>"+data["document"]+"</p>";

            content += "<form action=\"/challenges/submit\" method=\"POST\"><input type=\"text\" name=\"flag\"><input type=\"hidden\" name=\"challengeID\" value=\""+challengeID+"\"><input class=\"btn btn-default\" type=\"submit\"></form>"
            content_element.innerHTML = content; 

            container.appendChild(title_element);
            container.appendChild(content_element);

            document.body.appendChild(container)

        }
    }
}

function modifyDialog(challengeID){
    getChallengeDetail(challengeID);
}

function showDialog(challengeID){
    modifyDialog(challengeID);
    //获取对象
    var dialog = getE("alert-dialog");
    var mask = getE("dialog-mask");
    //显示dialog
    showE(dialog);
    //设置居中
    toCenter(dialog);
    //设置遮罩大小
    fillScreen(mask);
    //显示遮罩
    showE(mask);
}

function hideDialog(mask_id, dialog_id){
    //获取对象
    var mask = getE(mask_id);
    var dialog = getE(dialog_id);
    //隐藏登录框
    hideE(dialog);
    //隐藏遮罩层
    hideE(mask);
}

function alertDialog(dialog_title_id, dialog_id, mask_id) {
    if (getE(dialog_id) == null){
        create_alert_dialog()
        var elem = getE(dialog_title_id);
        var dialog = getE(dialog_id);
        var mask = getE(mask_id);
        console.log("new")
    }else{
        var elem = getE(dialog_title_id);
        var dialog = getE(dialog_id);
        var mask = getE(mask_id);
        console.log("old")
    }

    // console.log(elem)
    // console.log(dialog)

    // //开始处理拖动
    // //鼠标按下位置
    // var offsetX;
    // var offsetY;
    // //拖动状态标记
    // var isDraging = false;
    // //鼠标事件一(鼠标按下)
    // dialog.addEventListener("mousedown",function(e){
    //     var e = e || window.event;//兼容IE,IE的鼠标事件从window.event获得
    //     offsetX = e.pageX - dialog.offsetLeft;
    //     offsetY = e.pageY - dialog.offsetTop;
    //     isDraging = true;
    // })
    // //鼠标事件二(鼠标移动)
    // document.onmousemove = function(e){
    //     var e = e || window.event;//兼容IE,IE的鼠标事件从window.event获得
    //     //定义移动距离
    //     var moveX = e.pageX - offsetX;
    //     var moveY = e.pageY - offsetY;
    //     //获得页面可视尺寸
    //     var vH = document.documentElement.clientHeight;
    //     var vW = document.documentElement.clientWidth;
    //     //获取元素尺寸
    //     var eH = dialog.offsetHeight;
    //     var eW = dialog.offsetWidth;
    //     //最大移动举例
    //     var maxX = vW - eW;
    //     var maxY = vH - eH;
    //     if(isDraging === true){
    //         //限制移动范围(厉害!)
    //         moveX = Math.min(maxX,Math.max(0, moveX));
    //         moveY = Math.min(maxY,Math.max(0, moveY));
    //         dialog.style.left = moveX + "px";
    //         dialog.style.top = moveY + "px";
    //     }
    // }
    // //鼠标事件三(鼠标松开)
    // document.onmouseup = function(){
    //     isDraging = false;
    // }
}
function create_mask(mask_id, dialog_id) {
    var e = document.createElement("div");
    e.setAttribute("id", mask_id);
    e.setAttribute("onclick", "hideDialog(\""+mask_id+"\",\""+dialog_id+"\")");
    document.body.appendChild(e);
}

function addOnClickListener(elem_class_name) {
    var elements = document.getElementsByClassName(elem_class_name);
    for (var i = elements.length - 1; i >= 0; i--) {
        var challengeID = parseInt(elements[i].getElementsByTagName("li")[0]['id'].split("-")[1]);
        elements[i].setAttribute("onclick", "showDialog("+challengeID+")");
    }
}

function create_alert_dialog() {
    var container = document.createElement("div");
    container.setAttribute("id", "alert-dialog")

    var title = document.createElement("div");
    title.setAttribute("id", "alert-dialog-title")

    var content = document.createElement("div");
    content.setAttribute("id", "alert-dialog-content")

    container.appendChild(title);
    container.appendChild(content);

    document.body.appendChild(container)
}

var click_to_show_class_name = "click-to-alert-dialog"
var dialog_title_id = "alert-dialog-title";
var dialog_id = "alert-dialog";
var mask_id = "dialog-mask";
create_mask(mask_id, dialog_id);
addOnClickListener(click_to_show_class_name);
alertDialog(dialog_title_id, dialog_id, mask_id);

