<?php

/** Use add background-color yellow on table cell click
* @link https://www.adminer.org/plugins/#use
* @author Nugroho, reinstar.android@gmail.com
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerClickYellow {
	function head() { ?>
<script <?php echo nonce(); ?>>
	document.addEventListener("contextmenu", function(e){
		var MyNode = e.target;
		
		while (MyNode.nodeName !== 'TD' && MyNode.nodeName !== '#document') {
			MyNode = MyNode.parentNode;
		}
		
		if (MyNode.nodeName === 'TD') {
			if (MyNode.getAttribute("style") === 'background-color: rgb(255, 255, 0);') {
				MyNode.removeAttribute("style");
			}
			else {
				MyNode.setAttribute("style", "background-color: rgb(255, 255, 0);");
			}
			
			e.preventDefault();
		}
	}, false);
</script>
<?php
	}
}
