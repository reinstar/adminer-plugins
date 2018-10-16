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
	function getNode(node, name) {
		while (node.nodeName !== name && node.nodeName !== '#document') {
			node = node.parentNode;
		}

		return node;
	}

	function remDBLocal(key, value) {
		var data=[];

		if (localStorage) {
			data=JSON.parse(localStorage.getItem(key) || '[]');

			if (data.indexOf(value) != -1) {
				data.splice(data.indexOf(value), 1);

				localStorage.setItem(key, JSON.stringify(data));
			}
		}
	}

	function setDBLocal(key, value) {
		var data=[];

		if (localStorage) {
			data=JSON.parse(localStorage.getItem(key) || '[]');

			if (data.indexOf(value) == -1) {
				data.push(value);

				localStorage.setItem(key, JSON.stringify(data));
			}
		}
	}

	function getDBLocal(key) {
		var data=[];

		if (localStorage) {
			data=JSON.parse(localStorage.getItem(key) || '[]');
		}

		return data;
	}

	function clickCell(e) {
		var MyNode = getNode(e.target, 'TD');
		
		if (MyNode.nodeName === 'TD') {
			if (MyNode.getAttribute("style") === 'background-color: rgb(255, 255, 0);') {
				MyNode.removeAttribute("style");
			}
			else {
				MyNode.setAttribute("style", "background-color: rgb(255, 255, 0);");
			}
			
			e.preventDefault();
		}
	}

	function clickMenu(e) {
		var MyNode = getNode(e.target, 'LI');
		
		if (MyNode.nodeName === 'LI') {
			if (MyNode.getAttribute("style") === 'background-color: rgb(0, 255, 0);') {
				MyNode.removeAttribute("style");

				remDBLocal("click-yellow-menu", MyNode.getAttribute("data-table-name"));

				MyNode.childNodes.forEach(function(item){
					try {
						item.removeAttribute("style");
					}
					catch (error) {}
				});
			}
			else {
				MyNode.setAttribute("style", "background-color: rgb(0, 255, 0);");

				setDBLocal("click-yellow-menu", MyNode.getAttribute("data-table-name"));

				MyNode.childNodes.forEach(function(item){
					try {
						item.setAttribute("style", "background-color: transparent;");
					}
					catch (error) {}
				});
			}
			
			e.preventDefault();
		}
	}

	document.addEventListener("contextmenu", function(e) {
		clickCell(e);
		clickMenu(e);
	}, false);
		
	document.addEventListener("DOMContentLoaded", function(event) {
		setTimeout(function() {
			var menu = getDBLocal("click-yellow-menu");

			menu.forEach(function(item) {
				MyNode = document.querySelectorAll('li[data-table-name="'+item+'"]')[0];

				MyNode.setAttribute("style", "background-color: rgb(0, 255, 0);");

				MyNode.childNodes.forEach(function(item){
					try {
						item.setAttribute("style", "background-color: transparent;");
					}
					catch (error) {}
				});
			});
		}, 30);
	});

</script>
<?php
	}
}
