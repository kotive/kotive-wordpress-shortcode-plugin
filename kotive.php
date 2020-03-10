<?php
/*
Plugin Name: Kotive Workflow Shortcode
Description: Embed Kotive workflows and forms in pages and posts. Usage: <code>[kotive groupid="190" taskflowhash="1800e4ed80cb489381fff178f5dd4247" height="400"]</code>. This shortcode is available to copy and paste directly from the Workflow settings in the Kotive Designer.
Version: 1.0
License: GPL
Author: Kotive
Author URI: https://kotive.com
Text Domain: kotive-workflow-shortcode
*/

function createKotiveEmbed($atts, $content = null) {
	extract(shortcode_atts(array(
		'groupid'   => '',
		'taskflowhash'   => '',
		'height'     => '500',
	), $atts));

	if (!$groupid or !$taskflowhash) {

		$error = "
		<div style='border: 2px solid #C7C7C7; border-radius: 5px; padding: 40px; margin: 50px 0 70px;'>
			<h3>Oh!</h3>
			<p>Something is wrong with your Kotive shortcode. It should be good to go if you copy and paste it from the <a href='https://webapp.kotive.com/'>Kotive Designer</a>.</p>
		</div>";

		return $error;

	} else {

		$js = "<script type='text/javascript'>";
		$js .= '!function(){function e(e){var t=e.target||e.srcElement;t.__resizeRAF__&&_(t.__resizeRAF__),t.__resizeRAF__=r(function(){var i=t.__resizeTrigger__;i.__resizeListeners__.forEach(function(t){t.call(i,e)})})}function t(){this.contentDocument.defaultView.__resizeTrigger__=this.__resizeElement__,this.contentDocument.defaultView.addEventListener("resize",e)}var i=document.attachEvent,n=navigator.userAgent.match(/Trident/),r=function(){var e=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(e){return window.setTimeout(e,20)};return function(t){return e(t)}}(),_=function(){var e=window.cancelAnimationFrame||window.mozCancelAnimationFrame||window.webkitCancelAnimationFrame||window.clearTimeout;return function(t){return e(t)}}();window.addResizeListener=function(r,_){if(!r.__resizeListeners__)if(r.__resizeListeners__=[],i)r.__resizeTrigger__=r,r.attachEvent("onresize",e);else{"static"==getComputedStyle(r).position&&(r.style.position="relative");var o=r.__resizeTrigger__=document.createElement("object");o.setAttribute("style","display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; pointer-events: none; z-index: -1;"),o.__resizeElement__=r,o.onload=t,o.type="text/html",n&&r.appendChild(o),o.data="about:blank",n||r.appendChild(o)}r.__resizeListeners__.push(_)},window.removeResizeListener=function(t,n){t.__resizeListeners__.splice(t.__resizeListeners__.indexOf(n),1),t.__resizeListeners__.length||(i?t.detachEvent("onresize",e):(t.__resizeTrigger__.contentDocument.defaultView.removeEventListener("resize",e),t.__resizeTrigger__=!t.removeChild(t.__resizeTrigger__)))}}(),function(){function e(e){var t=e.target||e.srcElement;t.__resizeRAF__&&_(t.__resizeRAF__),t.__resizeRAF__=r(function(){var i=t.__resizeTrigger__;i.__resizeListeners__.forEach(function(t){t.call(i,e)})})}function t(){this.contentDocument.defaultView.__resizeTrigger__=this.__resizeElement__,this.contentDocument.defaultView.addEventListener("resize",e)}var i=document.attachEvent,n=navigator.userAgent.match(/Trident/),r=function(){var e=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(e){return window.setTimeout(e,20)};return function(t){return e(t)}}(),_=function(){var e=window.cancelAnimationFrame||window.mozCancelAnimationFrame||window.webkitCancelAnimationFrame||window.clearTimeout;return function(t){return e(t)}}();addResizeListener=function(r,_){if(!r.__resizeListeners__)if(r.__resizeListeners__=[],i)r.__resizeTrigger__=r,r.attachEvent("onresize",e);else{"static"==getComputedStyle(r).position&&(r.style.position="relative");var o=r.__resizeTrigger__=document.createElement("object");o.setAttribute("style","display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; pointer-events: none; z-index: -1;"),o.__resizeElement__=r,o.onload=t,o.type="text/html",n&&r.appendChild(o),o.data="about:blank",n||r.appendChild(o)}r.__resizeListeners__.push(_)},removeResizeListener=function(t,n){t.__resizeListeners__.splice(t.__resizeListeners__.indexOf(n),1),t.__resizeListeners__.length||(i?t.detachEvent("onresize",e):(t.__resizeTrigger__.contentDocument.defaultView.removeEventListener("resize",e),t.__resizeTrigger__=!t.removeChild(t.__resizeTrigger__)))};var o=document.getElementById("kotive-embedded-'.$taskflowhash.'"),s=o.parentElement,a=function(){var e=s.clientHeight;o.setAttribute("height",e)},c=null;addResizeListener(s,function(){c&&window.clearTimeout(c),c=window.setTimeout(function(){a(),c=null},100)}),a()}();';
		$js .= "</script>";

		$iframe = '<iframe id="kotive-embedded-'.$taskflowhash.'" src="https://webapp.kotive.com/hub/taskflow/init/'.$groupid.'/'.$taskflowhash.'/full/embed" frameborder="none" style="width:100%;border:0px;" height="'.$height.'">Fill out our <a href="https://webapp.kotive.com/hub/taskflow/init/'.$groupid.'/'.$taskflowhash.'/full" rel="nofollow">taskflow\'s form.</a></iframe>';

		return '<div id="kotive-taskflow-container" style="width:100%; height:'.$height.'px;">'.$iframe.''.$js.'</div>';
	}
}

add_shortcode('kotive', 'createKotiveEmbed');

?>
