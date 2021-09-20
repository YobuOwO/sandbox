
<html>
<head>
    <title> Index Page </title>
    <link rel="stylesheet" href="css/external_main.css">
</head>
<body>
    <div id="alert_frame">
        <iframe src="alert_frame.php" height="500" width="500" frameborder="0" id="alert_iframe"></iframe>
    </div>
    <div id ="main_settings">
        <span>
            <input type="text" id="alert_name" placeholder="Type your name here"/>
            <button id="generate" onclick="generate()">Generate</button>
            <button id="rerun" onclick="refresh()">Re-run</button>
        </span>
        <div id="left_settings">
            <span>
            <label for="intro_id">Intro Preset</label>
                <select id="intro_id">
                    <option value="Default" id="default">Default</option>
                    <option value="Intro 1" id="intro_1">Intro 1</option>
                    <option value="Intro 2" id="intro_2">Intro 2</option>
                    <option value="Intro 3" id="intro_3">Intro 3</option>
                    <option value="Intro 4" id="intro_4">Intro 4</option>
                    <option value="Intro 5" id="intro_5">Intro 5</option>
                </select>
            </span>
            <span>
                <label for="outro_id">Outro Preset</label>
                <select id="outro_id">
                    <option value="Default" id="default">Default</option>
                    <option value="Outro 1" id="outro_1">Outro 1</option>
                    <option value="Outro 2" id="outro_2">Outro 2</option>
                    <option value="Outro 3" id="outro_3">Outro 3</option>
                    <option value="Outro 4" id="outro_4">Outro 4</option>
                    <option value="Outro 5" id="outro_5">Outro 5</option>
                </select>
            </span>
        </div>
        <div id="right_settings">
            <label for="anim_duration">Duration</label>
            <input type="range" id="anim_duration" class="slider" value="5" min="3" max="10">
            <label for="keyframe_settings">Keyframes</label>
            <input type="range" id="keyframe_settings" class="slider" value="0" min="3" max="100">
        </div>
    </div>
    <div id="code_frames">
        <iframe src="generated_code/gen_html.txt" height="500" width="500" frameborder="0" id="html_iframe"></iframe>
        <iframe src="generated_code/gen_css.txt" height="500" width="500" frameborder="0" id="css_iframe"></iframe>
        <iframe src="generated_code/gen_js.txt" height="500" width="500" frameborder="0" id="js_iframe"></iframe>
    </div>
    <!-- <iframe src="css/alert_style.css" height="200" width="300" frameborder="0" id="css_iframe"></iframe> -->
    <script type="text/javascript">
        function refresh() {
            document.getElementById('alert_iframe').contentDocument.location.reload(true);
        }
        function selectAnimation(iframe) {
            var animation_full;
            var intro_keyframe_start, intro_keyframe_end, outro_keyframe_start, outro_keyframe_end;
            var delay_duration = 0;
            var intro_keyframe_mid = "";
            var outro_keyframe_mid = "";
            let dynamicStyleSheet = null;

            const fade_keyframe_in = "opacity: 1;";
            const fade_keyframe_out = "opacity: 0;";

            const intro1_keyframe_start = "top: 55%; opacity: 0;";
            const intro1_keyframe_end = "opacity: 1; top: 50%";

            const intro2_keyframe_start = "clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)";
            const intro2_keyframe_end = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";

            const intro3_keyframe_start = "clip-path: polygon(50% 90%, 50% 90%, 50% 95%, 50% 95%);";
            const intro3_keyframe_mid = "clip-path: polygon(0% 90%, 100% 90%, 100% 95%, 0% 95%)";
            const intro3_keyframe_end = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";

            const intro5_keyframe_start = "top: 40% ; clip-path: polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%);";
            const intro5_keyframe_end = "top: 50%; clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);";

            const outro1_keyframe_start = "top: 50%; opacity: 1;";
            const outro1_keyframe_end = "opacity: 0; top: 55%";

            const outro2_keyframe_start = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";
            const outro2_keyframe_end = "clip-path: polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)";

            const outro3_keyframe_start = "clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)";
            const outro3_keyframe_mid = "clip-path: polygon(0% 90%, 100% 90%, 100% 95%, 0% 95%)";
            const outro3_keyframe_end = "clip-path: polygon(50% 90%, 50% 90%, 50% 95%, 50% 95%)";

            const outro5_keyframe_start = "top: 50% ; clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);"
            const outro5_keyframe_end = "top: 60%; clip-path: polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%);"
            
            if(!dynamicStyleSheet) {
                dynamicStyleSheet = iframe.contentWindow.document.createElement("style");
                dynamicStyleSheet.type = "text/css";
                iframe.contentWindow.document.head.appendChild(dynamicStyleSheet);
            }
            if(document.getElementById("intro_id").value == "Intro 3" || document.getElementById("outro_id").value == "Outro 3") {
                iframe.contentWindow.document.getElementById("alert_title").style.textDecoration = "underline";
                //iframe.contentWindow.document.getElementById("alert_title").style.textDecorationThickness = "7px";
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
            var keyframes = "@keyframes full_animation {0% {" + intro_keyframe_start + "} 20% {" + intro_keyframe_mid + "} 40% {" + intro_keyframe_end + "} 60% {" + outro_keyframe_start + "} 80% {" + outro_keyframe_mid + "} 100% {" + outro_keyframe_end + "} }" //write this to file
            var container_css = "#alert_container {position: absolute; top: 50%; left: 50%; animation-name: full_animation; animation-delay: " + delay_duration.toString()  + "s; animation-duration: " + document.getElementById("anim_duration").value.toString() + "s; animation-fill-mode: forwards;}"
            dynamicStyleSheet.sheet.insertRule(
                keyframes, dynamicStyleSheet.length
            );
            iframe.contentWindow.document.getElementById("alert_container").style.fontFamily = "Helvetica, Arial, sans-serif";
            iframe.contentWindow.document.getElementById("alert_container").style.animationName = "full_animation";
            iframe.contentWindow.document.getElementById("alert_container").style.animationDuration = document.getElementById("anim_duration").value.toString() + "s";
            iframe.contentWindow.document.getElementById("alert_container").style.animationFillMode = "forwards";
            iframe.contentWindow.document.getElementById("alert_container").style.animationDelay =  "0s";
            

            iframe.contentWindow.document.getElementById("alert_container").style.position = "absolute";
            iframe.contentWindow.document.getElementById("alert_container").style.left = "40%";
            iframe.contentWindow.document.getElementById("alert_container").style.top = "50%";

            iframe.contentWindow.document.getElementById("alert_title").style.color = "black";
            iframe.contentWindow.document.getElementById("alert_title").style.fontSize = "25px";

            iframe.contentWindow.document.getElementById("animation").innerHTML = document.getElementById("intro_id").value + " " + document.getElementById("outro_id").value;
            iframe.contentWindow.document.getElementById("animation-name").innerHTML = animation_full;
            iframe.contentWindow.document.getElementById("duration").innerHTML = document.getElementById("anim_duration").value.toString() + "s";

        }
        function generate() {
            var iframe = document.getElementById("alert_iframe");
            
            iframe.contentWindow.document.getElementById("alert_title").innerHTML = document.getElementById("alert_name").value;
            selectAnimation(iframe);
        }
    </script>
</body>
</html>