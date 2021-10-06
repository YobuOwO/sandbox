function refresh() {
    document.getElementById('alert_iframe').contentDocument.location.reload(true);
}
function selectAnimation(iframe) {
    var animation_full;
    var intro_keyframe_start, intro_keyframe_end, outro_keyframe_start, outro_keyframe_end;
    var intro_keyframe_mid = "";
    var outro_keyframe_mid = "";
    let dynamicStyleSheet = null;
    var animation_fill_mode = document.getElementById("fill-mode").value;
    var animation_delay = document.getElementById("anim_delay").value;

    const fade_keyframe_in = "opacity: 1";
    const fade_keyframe_out = "opacity: 0";

    const intro1_keyframe_start = "top: 55%; opacity: 0";
    const intro1_keyframe_end = "opacity: 1; top: 50%";

    const intro2_keyframe_start = "clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)";
    const intro2_keyframe_end = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";

    const intro3_keyframe_start = "clip-path: polygon(50% 90%, 50% 90%, 50% 95%, 50% 95%)";
    const intro3_keyframe_mid = "clip-path: polygon(0% 90%, 100% 90%, 100% 95%, 0% 95%)";
    const intro3_keyframe_end = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";

    const intro5_keyframe_start = "top: 40% ; clip-path: polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%)";
    const intro5_keyframe_end = "top: 50%; clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";

    const outro1_keyframe_start = "top: 50%; opacity: 1;";
    const outro1_keyframe_end = "opacity: 0; top: 55%";

    const outro2_keyframe_start = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";
    const outro2_keyframe_end = "clip-path: polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)";

    const outro3_keyframe_start = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";
    const outro3_keyframe_mid = "clip-path: polygon(0% 90%, 100% 90%, 100% 95%, 0% 95%)";
    const outro3_keyframe_end = "clip-path: polygon(50% 90%, 50% 90%, 50% 95%, 50% 95%)";

    const outro5_keyframe_start = "top: 50% ; clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)"
    const outro5_keyframe_end = "top: 60%; clip-path: polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)"
    
    if(!dynamicStyleSheet) {
        dynamicStyleSheet = iframe.contentWindow.document.createElement("style");
        dynamicStyleSheet.type = "text/css";
        iframe.contentWindow.document.head.appendChild(dynamicStyleSheet);
    }
    if(document.getElementById("intro_id").value == "Intro 3" || document.getElementById("outro_id").value == "Outro 3") {
        iframe.contentWindow.document.getElementById("alert_title").style.textDecoration = "underline";
    }
    switch(document.getElementById("intro_id").value) {
        case "Intro 1":
            intro_keyframe_start = intro1_keyframe_start;
            intro_keyframe_end = intro1_keyframe_end;
            animation_full = "intro1, ";
            break;
        case "Intro 2":
            intro_keyframe_start = intro2_keyframe_start;
            intro_keyframe_end = intro2_keyframe_end;
            animation_full = "intro2, ";
            break;
        case "Intro 3":
            intro_keyframe_start = intro3_keyframe_start;
            intro_keyframe_mid = intro3_keyframe_mid;
            intro_keyframe_end = intro3_keyframe_end;
            animation_full = "intro3, ";
            break;
        case "Intro 5":
            intro_keyframe_start = intro5_keyframe_start;
            intro_keyframe_end = intro5_keyframe_end;

            animation_full = "intro5, ";
            break;
        default:
            intro_keyframe_start = fade_keyframe_out;
            intro_keyframe_end = fade_keyframe_in;
            animation_full = "fade_in, ";
            break;
    }
    switch(document.getElementById("outro_id").value) {
        case "Outro 1":
            outro_keyframe_start = outro1_keyframe_start;
            outro_keyframe_end = outro1_keyframe_end;
            animation_full += "outro1";
            break;
        case "Outro 2":
            outro_keyframe_start = outro2_keyframe_start;
            outro_keyframe_end = outro2_keyframe_end;
            animation_full += "outro2";
            break;
        case "Outro 3":
            outro_keyframe_start = outro3_keyframe_start;
            outro_keyframe_mid = outro3_keyframe_mid;
            outro_keyframe_end = outro3_keyframe_end;
            animation_full += "outro3";
            break;
        case "Outro 5":
            outro_keyframe_start = outro5_keyframe_start;
            outro_keyframe_end = outro5_keyframe_end;
            animation_full += "outro5";
            break;
        default:
            outro_keyframe_start = fade_keyframe_in;
            outro_keyframe_end = fade_keyframe_out;
            animation_full += "fade_out";
            break;
    }

    var keyframes = "@keyframes full-animation {<br>&emsp;0% {" + intro_keyframe_start + "} <br>&emsp;20% {" + intro_keyframe_mid + "} <br>&emsp;40% {" + intro_keyframe_end + "} <br>&emsp;60% {" + outro_keyframe_start + "} <br>&emsp;80% {" + outro_keyframe_mid + "} <br>&emsp;100% {" + outro_keyframe_end + "} <br>}" //write this to file
    var keyframes_clean = "@keyframes full-animation {0% {" + intro_keyframe_start + "} 20% {" + intro_keyframe_mid + "} 40% {" + intro_keyframe_end + "} 60% {" + outro_keyframe_start + "} 80% {" + outro_keyframe_mid + "} 100% {" + outro_keyframe_end + "} }"
    var container_css = "#alert_container {<br>&emsp;position: relative; <br>&emsp;top: 50%; <br>&emsp;left: 0; <br>&emsp;right: 0; <br>&emsp;margin: auto; <br>&emsp;width: 75%;<br>&emsp;animation-name: full-animation; <br>&emsp;animation-delay: " + animation_delay.toString()  + "s; <br>&emsp;animation-duration: " + document.getElementById("anim_duration").value.toString() + "s; <br>&emsp;animation-fill-mode: " + animation_fill_mode + ";<br>}"
    var html_content = '&lt;div id="alert_container"&gt; <br>&emsp;&lt;div id="alert_title"&gt;<br>&emsp;&emsp;'  +  document.getElementById("alert_name").value + '<br>&emsp;&lt;/div&gt;<br>&lt;/div&gt;';

    dynamicStyleSheet.sheet.insertRule(
        keyframes_clean, dynamicStyleSheet.length
    );

    css_content = keyframes + "<br><br>" + container_css;
    js_content = "";

    iframe.contentWindow.document.getElementById("alert_container").style.fontFamily = "Helvetica, Arial, sans-serif";
    iframe.contentWindow.document.getElementById("alert_container").style.animationName = "full-animation";
    iframe.contentWindow.document.getElementById("alert_container").style.animationDuration = document.getElementById("anim_duration").value.toString() + "s";
    iframe.contentWindow.document.getElementById("alert_container").style.animationFillMode = animation_fill_mode;
    iframe.contentWindow.document.getElementById("alert_container").style.animationDelay =  animation_delay.toString() + "s";
    

    iframe.contentWindow.document.getElementById("alert_container").style.position = "relative";
    // iframe.contentWindow.document.getElementById("alert_container").style.left = "25%";
    // iframe.contentWindow.document.getElementById("alert_container").style.right = "0";
    iframe.contentWindow.document.getElementById("alert_container").style.margin = "auto";
    iframe.contentWindow.document.getElementById("alert_container").style.width = "75%";
    iframe.contentWindow.document.getElementById("alert_container").style.top = "50%";

    iframe.contentWindow.document.getElementById("alert_title").style.color = "black";
    iframe.contentWindow.document.getElementById("alert_title").style.fontSize = "25px";

    generateFile(html_content, css_content, js_content);
}
function generate() {
    var iframe = document.getElementById("alert_iframe");
    
    iframe.contentWindow.document.getElementById("alert_title").innerHTML = document.getElementById("alert_name").value;
    selectAnimation(iframe);
}
function generateFile(html_content, css_content, js_content) {
    var html_iframe = document.getElementById("html_iframe");
    var css_iframe = document.getElementById("css_iframe");
    var js_iframe = document.getElementById("js_iframe");
    html_iframe.contentWindow.document.getElementById("html_content").innerHTML = html_content;
    css_iframe.contentWindow.document.getElementById("css_content").innerHTML = css_content;
    js_iframe.contentWindow.document.getElementById("js_content").innerHTML = js_content;
}

function changeDelaySlider() {
    document.getElementById("anim_delay").value = document.getElementById("anim_delay_text").value;
}
function changeDelayTextBox() {
    document.getElementById("anim_delay_text").value = document.getElementById("anim_delay").value;
}

function changeDurationSlider() {
    document.getElementById("anim_duration").value = document.getElementById("anim_duration_text").value;
}
function changeDurationTextBox() {
    document.getElementById("anim_duration_text").value = document.getElementById("anim_duration").value;
}