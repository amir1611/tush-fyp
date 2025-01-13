<?php
date_default_timezone_set('Asia/Jerusalem');
include('include/functions.php');

//$currentFile = $_SERVER["PHP_SELF"];
//$parts = Explode('/', $currentFile);
//$page_name= $parts[count($parts) - 1];
//if ($page_name=="index2.php")
//	$testing_file_name_postfix="2";
//else
//	$testing_file_name_postfix="";

$file_action = "config-generator-do/";	//.$testing_file_name_postfix;
$file_style = "style.css"; 		//.$testing_file_name_postfix.".css";
$file_js_script = "script.js"; 		//.$testing_file_name_postfix.".js";
$file_tabber = "tabber.js"; 		//.$testing_file_name_postfix.".js";
$file_sessvars = "sessvars.js"; 		//.$testing_file_name_postfix.".js";

if ($_POST)
	$todo = escapeshellcmd(trim($_POST['todo']));

inc_init_session();
inc_print_page_head();

$URI = $_SERVER["REQUEST_URI"];
$ver = "v1.8";
if (!isset($todo)) {
	$todo = "example";
}
if ($todo == "load") {
	$upload_tmp_name = $_FILES['uploadedfile']['tmp_name'];
	if ($upload_tmp_name) {
		if (!($_FILES['uploadedfile']['type'] == 'text/plain'))
			die("<font color='red'>error: Only text files allowd</font><br>If it's a legitimate configuration file, try changing file extension to '.txt'");

		$upload_new_name = func_cp($upload_tmp_name, "ConfigGenerator");
		if ($upload_new_name)
			$conf = parse_ini_file($upload_new_name);
		else
			die("error: can't move file");
	} else {
		print "<font color =red>Error: No File selected</font><br/>";
		$todo = "load_error";
	}
} elseif ($todo == "example") {
	$conf = parse_ini_file("example.dat");
	$todo = "load"; // that all fields will be fillds
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Config Generator - Generate Cisco, Juniper and Nortel config</title>
	<meta name="description"
		content="An online tool - Config Generator, Here you can Generate configuration files for Cisco, Juniper and Nortel switches" />
	<meta name="keywords"
		content="Config Generator, config, Generate, Generator, cisco, nortel, juniper, tools, free, switch, switches, router, routers, config, configure, Cisco, Nortel, Juniper, Hostname, IP address, Subnet Mask, Default Gateway, Routing enabled, Managment Vlan, stack, Interfaces Name, Description, Speed [auto / 10 / 100 / 1000 / 10000], Duplex [auto / full / half], Vlans No.,  Vlan Tagging (802.1q), Native Vlan No.(PVID at Nortel), Spanning tree,Port mode[ normal / portfast ],Spanning tree Mode,Bridge priority,vlans Name,valns Ip address, vlans Subnet Mask, Redundancy, VRRP/HSRP,  Priorety, preemption " />
	<meta http-equiv="content-Type" content="text/html; charset=windows-1255" />

	<link rel="stylesheet" type="text/css" href="/<?php print $file_style ?>">

	<link rel="stylesheet" href="tabber.css" type="text/css" media="screen">

	<script type="text/javascript" src="<?php print $file_tabber; ?>"></script>
	<script type="text/javascript">
		/* Optional: if we want to use programmatic tabs */
		var tabberOptions = {
			'manualStartup': false,
			'onLoad': function (argsObj) {
				// Hide the default tab navigation after it's created
				document.querySelector('.tabbernav').style.display = 'none';
			}
		};
	</script>
	<script type="text/javascript" src="<?php print $file_sessvars; ?>"></script>
	<script type="text/javascript">
		var php_todo = "<?php print $todo; ?>";
	</script>
	<script type="text/javascript" src="<?php print $file_js_script ?>"></script>

	<link rel="stylesheet" href="generator.css">

</head>

<body>
	<form name="frm_main" action="<?php print $file_action; ?>" target="iframe1" enctype="multipart/form-data"
		method="POST">
		<input type="hidden" name="todo" value="generate" />
		<input type="hidden" name="ver" value="<?php print $ver ?>">
		<div class="generator-content">
			<h2 class="generator-title">Config Generator</h2>

			<div class="tab-navigation">
				<button type="button" id="prevTab" class="nav-button" onclick="navigateTab('prev')">&larr;
					Previous</button>
				<span id="currentSection">Section: General</span>
				<button type="button" id="nextTab" class="nav-button" onclick="navigateTab('next')">Next
					&rarr;</button>
			</div>

			<div class="table-container">
				<table class="generator-table">
					<tr align=center>
						<td width="50"
							onclick="javascript:if(confirm('Reset settings\nAre you sure ?')) document.frm_reset.submit();">
							<img src="images/new.jpg" style="height:20px;width:20px" /><br />
							<font size="2px">New</font>
						</td>
						<td width="50"
							onclick="javascript:document.getElementById('div_load').style.visibility = 'visible';">
							<img src="images/open.jpg" style="height:25px;width:25px" /><br />
							<font size="2px">Open</font>
						</td>
						<td width="50" onclick="javascript:save_settings();"><img src="images/save.jpg"
								style="height:25px;width:25px" /><br />
							<font size="2px">Save</font>
						</td>
						<td width="50"
							onclick="javascript:if(confirm('Loading settings will make you to lose all the current settings\nAre you sure ?')) document.frm_example.submit();">
							<img src="images/example.jpg" style="height:25px;width:25px" /><br />
							<font size="2px">Example</font>
						</td>
					</tr>
				</table>
			</div>

			<div class="tabber">
				<div class="tabbertab">
					<h2 class="text-center">General</h2>
					<p class="text-center">To configure the device, select the vendor from the dropdown menu, then
						add the hostname, IP address, subnet mask, and default gateway.</p>
					<p class="text-center">The form requires you to specify the vendor, hostname, IP address, subnet
						mask, and default gateway for the device</p>
					<p>
					<table border=1 style="border-color: white;border-style: none;">
						<tr align=left>
							<td>
								Vendor:</td>
							<td>
								<select name=vendor>
									<option value="cisco_ios" <?php print ($todo == "load") ? (($conf["vendor"] == "cisco_ios") ? "selected" : "") : "selected"; ?>>Cisco
										(IOS)
									</option>
									<option value="juniper_junos" <?php print ($todo == "load") ? (($conf["vendor"] == "juniper_junos") ? "selected" : "") : ""; ?>>Juniper
										(JunOS)
									</option>
									<option value="nortel" <?php print ($todo == "load") ? (($conf["vendor"] == "nortel") ? "selected" : "") : ""; ?>>Nortel (small
										switches)</option>
								</select>
							</td>
						</tr>
						<tr align=left>
							<td>

								Hostname:</td>
							<td>
								<Input type="text" name=hostname
									value="<?php print ($todo == "load") ? $conf["hostname"] : ""; ?>">
							</td>
						</tr>
						<tr align=left>
							<td>

								IP address: </td>
							<td>
								<Input type="text" name=ip value="<?php print ($todo == "load") ? $conf["ip"] : ""; ?>">
							</td>
						</tr>
						<tr align=left>
							<td>

								Subnet Mask: </td>
							<td>
								<Input type="text" name=subnetmask
									value="<?php print ($todo == "load") ? $conf["subnetmask"] : "255.255.255.0"; ?>">
							</td>
						</tr>
						<tr align=left>
							<td>

								Default Gateway: </td>
							<td>
								<Input type="text" name=defaultgateway
									value="<?php print ($todo == "load") ? $conf["defaultgateway"] : ""; ?>">
							</td>
						</tr>
						<tr align=left>
							<td>

								Routing enabled: </td>
							<td>
								<select name=routing_enabled>
									<option value="no" <?php print ($todo == "load") ? (($conf["routing_enabled"] == "no") ? "selected" : "") : ""; ?>>No</option>
									<option value="yes" <?php print ($todo == "load") ? (($conf["routing_enabled"] == "yes") ? "selected" : "") : "selected"; ?>>Yes
									</option>
								</select>
							</td>
						</tr>
						<tr align=left>
							<td>


								Managment Vlan:<br />(for Nortel)</td>
							<td>
								<Input type="text" name=mgmt_vlan
									value="<?php print ($todo == "load") ? $conf["mgmt_vlan"] : "1"; ?>">
							</td>
						</tr>
						<tr align=left>
							<td>

								stack: </td>
							<td>
								<select name=stack>
									<option value="no" <?php print ($todo == "load") ? (($conf["stack"] == "no") ? "selected" : "") : "selected"; ?>>No</option>
									<option value="yes" <?php print ($todo == "load") ? (($conf["stack"] == "yes") ? "selected" : "") : ""; ?>>Yes</option>
								</select>
							</td>
						</tr>
					</table>
					</p>
				</div>
				<div class="tabbertab">
					<h2 style="text-align: center;">Ports</h2>
					<p>
					<div class="ports-config">
						<br />
						<div class="ports-info">Configure ports easily by filling in the details below.<br />
							Use the dropdowns and text fields to customize each port's settings. All configurations
							can be saved for future reference.</div>
						<b>Configure Ports</b>:
						<select name=configure_Ports>
							<option value="no" <?php print ($todo == "load") ? (($conf["configure_Ports"] == "no") ? "selected" : "") : ""; ?>>No</option>
							<option value="yes" <?php print ($todo == "load") ? (($conf["configure_Ports"] == "yes") ? "selected" : "") : "selected"; ?>>Yes</option>
						</select>
					</div>

					<div class="table-wrapper">
						<table class="xl">
							<tr align=center>
								<td>Int Name</td>
								<td>Description</td>
								<td>Speed<br />[auto/10/100<br />/1000/10000]</td>
								<td>Duplex<br />[auto / full / half]</td>
								<td>Vlans No.<br />[1 / 1,2]</td>
								<td>Vlan Tagging<br />(802.1q)<br />[y / n]</td>
								<td>Native Vlan No.<br />(PVID at Nortel)</td>
								<td>Spanning tree<br />Port mode<br />[ normal / portfast ]</td>
							</tr>
							<?php
							for ($loop = 1; $loop < 49; $loop++) {
								print "<td><textarea COLS=15 ROWS=1 WRAP=OFF name=p" . $loop . "_0 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,0)\">" . (($todo == "load") ? $conf["p" . $loop . "_0"] : "Fa0/$loop") . "</TEXTAREA></td>
										<td><textarea COLS=15 ROWS=1 WRAP=OFF name=p" . $loop . "_1 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,1)\">" . (($todo == "load") ? $conf["p" . $loop . "_1"] : "") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_2 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,2)\">" . (($todo == "load") ? $conf["p" . $loop . "_2"] : "auto") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_3 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,3)\">" . (($todo == "load") ? $conf["p" . $loop . "_3"] : "auto") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_4 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,4)\">" . (($todo == "load") ? $conf["p" . $loop . "_4"] : "") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_5 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,5)\">" . (($todo == "load") ? $conf["p" . $loop . "_5"] : "n") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_6 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,6)\">" . (($todo == "load") ? $conf["p" . $loop . "_6"] : "") . "</TEXTAREA></td>
										<td><textarea COLS=10 ROWS=1 WRAP=OFF name=p" . $loop . "_7 class='xl'  oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'p');\" onkeyup=\"formatCells(this.value,'p',$loop,7)\">" . (($todo == "load") ? $conf["p" . $loop . "_7"] : "portfast") . "</TEXTAREA></td>
										</tr>";
							}
							?>
						</table>
					</div>
					</p>
				</div>
				<div class="tabbertab">
					<h2 style="text-align: center;">STP</h2>
					<p>
						Spanning tree:<br />
						Configure STP by selecting the mode (e.g., Rapid STP) and setting the bridge priority (0 to
						61440 in increments of 4096).<br />
					<table>
						<tr align=center>
							<td>
								Mode:</td>
							<td>
								<select name=stp_mode>
									<option value="stp" <?php print ($todo == "load") ? (($conf["stp_mode"] == "stp") ? "selected" : "") : "selected"; ?>>STP</option>
									<option value="rstp" <?php print ($todo == "load") ? (($conf["stp_mode"] == "rstp") ? "selected" : "") : ""; ?>>Rapid STP</option>
								</select>
							</td>
						</tr>
						<tr align=center>
							<td>

								Bridge priority: </td>
							<td>
								<Input type="text" name=stp_Priority
									value="<?php print ($todo == "load") ? $conf["stp_Priority"] : ""; ?>">
							</td>
						</tr>
					</table><br />
					<table>
						<tr align=center>
							<td>
								<font color=gray> Bridge priority can be 0 to 61440 in increments of 4096,<br />
									The default priority for switches is 32768<br />
									Usually The Root Bridge priority is 4096
								</font>
							</td>
						</tr>
					</table>
					</p>
				</div>
				<div class="tabbertab">
					<h2 style="text-align: center;">Vlans</h2>
					<p>

						<br />
						<font color=black>Configure VLANs by entering the required details in the fields below.
							Specify the VLAN ID, name, IP address, and subnet mask for each VLAN.</font><br />
						<font color=black>Use the dropdown to enable or disable VLAN configuration.</font><br />
						<b>Configure Vlans</b>:
						<select name=configure_Vlans>
							<option value="no" <?php print ($todo == "load") ? (($conf["configure_Vlans"] == "no") ? "selected" : "") : ""; ?>>No</option>
							<option value="yes" <?php print ($todo == "load") ? (($conf["configure_Vlans"] == "yes") ? "selected" : "") : "selected"; ?>>Yes</option>
						</select><br />
					<div class="table-wrapper">
						<table class="xl">
							<tr align=center>
								<td>#</td>
								<td>Name</td>
								<td>Ip address</td>
								<td>Subnet Mask</td>
							</tr>
							<?php
							for ($loop = 1; $loop < 11; $loop++) {
								print "<td><textarea COLS=5  ROWS=1 WRAP=OFF name=v" . $loop . "_0 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'v');\" onkeyup=\"formatCells(this.value,'v',$loop,0)\">" . (($todo == "load") ? $conf["v" . $loop . "_0"] : $loop) . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=v" . $loop . "_1 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'v');\" onkeyup=\"formatCells(this.value,'v',$loop,1)\">" . (($todo == "load") ? $conf["v" . $loop . "_1"] : "") . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=v" . $loop . "_2 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'v');\" onkeyup=\"formatCells(this.value,'v',$loop,2)\">" . (($todo == "load") ? $conf["v" . $loop . "_2"] : "") . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=v" . $loop . "_3 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'v');\" onkeyup=\"formatCells(this.value,'v',$loop,3)\">" . (($todo == "load") ? $conf["v" . $loop . "_3"] : "") . "</TEXTAREA></td>
									</tr>";
							}
							?>
						</table>
					</div>

					</p>
				</div>
				<div class="tabbertab">
					<h2 style="text-align: center;">VRRP/HSRP</h2>
					<p>
						<font color=gray>VRRP (Virtual Router Redundancy Protocol) and HSRP (Hot Standby Router
							Protocol) ensure network gateway redundancy by providing a virtual IP address shared
							among routers. If the primary router fails, a backup automatically takes over,
							maintaining connectivity.</font><br />
						<font color=gray>Enable VRRP/HSRP, input the group number, priority, and virtual IP, then
							save or export the configuration.</font><br />
						<b>Configure VRRP/HSRP</b>:
						<select name=configure_VRRP>
							<option value="no" <?php print ($todo == "load") ? (($conf["configure_VRRP"] == "no") ? "selected" : "") : "selected"; ?>>No</option>
							<option value="yes" <?php print ($todo == "load") ? (($conf["configure_VRRP"] == "yes") ? "selected" : "") : ""; ?>>Yes</option>
						</select><br />
					<div class="table-wrapper">
						<table class="xl">
							<tr align=center>
								<td>Vlan No.<br />
								<td>Redundancy group<br />(usually same as<br /> vlan no.)<br /></td>
								<td>Redundancy IP<br />(Cisco - HSRP<br />All other - VRRP)</td>
								<td>Redundancy Priorety<br />(usually Master=150,<br /> Standby=100></td>
								<td>Redundancy preemption<br />[y / n]</td>
							</tr>
							<?php
							for ($loop = 1; $loop < 11; $loop++) {
								print "<td><textarea COLS=15 ROWS=1 WRAP=OFF name=vrrp" . $loop . "_0 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'vrrp');\" onkeyup=\"formatCells(this.value,'vrrp',$loop,0)\">" . (($todo == "load") ? $conf["vrrp" . $loop . "_0"] : $loop) . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=vrrp" . $loop . "_1 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'vrrp');\" onkeyup=\"formatCells(this.value,'vrrp',$loop,1)\">" . (($todo == "load") ? $conf["vrrp" . $loop . "_1"] : $loop) . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=vrrp" . $loop . "_2 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'vrrp');\" onkeyup=\"formatCells(this.value,'vrrp',$loop,2)\">" . (($todo == "load") ? $conf["vrrp" . $loop . "_2"] : "") . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=vrrp" . $loop . "_3 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'vrrp');\" onkeyup=\"formatCells(this.value,'vrrp',$loop,3)\">" . (($todo == "load") ? $conf["vrrp" . $loop . "_3"] : "") . "</TEXTAREA></td>
									<td><textarea COLS=15 ROWS=1 WRAP=OFF name=vrrp" . $loop . "_4 class='xl' oncontextmenu=\"return false;\" onmousedown=\"MouseDown(this,'vrrp');\" onkeyup=\"formatCells(this.value,'vrrp',$loop,4)\">" . (($todo == "load") ? $conf["vrrp" . $loop . "_4"] : "n") . "</TEXTAREA></td>
									</tr>";
							}
							?>
						</table>
					</div>

					</p>
				</div>
				<div class="tabbertab">
					<h2 style="text-align: center;">Config</h2>
					<p style="color: gray; margin-bottom: 20px;">
						Generate, copy, or download configurations for your network devices seamlessly. Simply click
						"Generate Config" to create and manage your custom settings.
					</p>
					<p>
						<input type="submit" name="btn_go" value="Generate config"
							style="color: white; background-color: blue" /><br /><br />

						<!-- Add iframe for displaying the generated configuration -->
						<IFRAME id="config_iframe" name="iframe1" WIDTH="900" HEIGHT="400">
							If you can see this, your browser doesn't understand IFRAME.
						</IFRAME>

						<br />

						<!-- Button for copying the text -->
						<input type="button" name="btn_copy" value="Copy Config" onclick="copyConfigText()"
							style="color: white; background-color: green" />

						<!-- Button for downloading the text file -->
						<input type="button" name="btn_download" value="Download Config" onclick="downloadConfigFile()"
							style="color: white; background-color: orange" />
					</p>

					<script>
						// Function to copy the content of the iframe
						function copyConfigText() {
							const iframe = document.getElementById('config_iframe');
							let iframeDocument = iframe.contentWindow || iframe.contentDocument;
							if (iframeDocument.document) iframeDocument = iframeDocument.document;

							const text = iframeDocument.body.textContent || iframeDocument.body.innerText;

							// Ensure proper formatting for copied text
							const formattedText = text.replace(/([^\n])#/g, "$1\n#").replace(/([^\n])set/g, "$1\nset");

							if (navigator.clipboard) {
								navigator.clipboard.writeText(formattedText).then(() => {
									alert("Configuration copied to clipboard!");
								}).catch(err => {
									alert("Failed to copy text: " + err);
								});
							} else {
								alert("Clipboard API is not supported in this browser.");
							}
						}

						function downloadConfigFile() {
							const iframe = document.getElementById('config_iframe');
							let iframeDocument = iframe.contentWindow || iframe.contentDocument;
							if (iframeDocument.document) iframeDocument = iframeDocument.document;

							const text = iframeDocument.body.textContent || iframeDocument.body.innerText;

							// Ensure proper formatting for downloaded text
							const formattedText = text.replace(/([^\n])#/g, "$1\n#").replace(/([^\n])set/g, "$1\nset");

							const blob = new Blob([formattedText], { type: "text/plain" });
							const link = document.createElement("a");
							link.href = URL.createObjectURL(blob);
							link.download = "config.txt";
							link.click();
							URL.revokeObjectURL(link.href); // Clean up
						}

					</script>

				</div>
			</div>
		</div>
	</form>
	</div>

	<div id="div_load" class="box" style="visibility: hidden;">
		<form name="frm_load" action="<?php print $URI ?>" enctype="multipart/form-data" method="POST">
			<input type=hidden name="todo" value="load" />
			<table border=0 width="100%" class="box">
				<tr align=center>
					<td>
						<br />
						<span style="font-size:5">File Load</span>
					</td>
				</tr>
				<tr align=center>
					<td>
						<input type=file name="uploadedfile" style="background-color: white" />
					</td>
				</tr>
				<tr align=center>
					<td>
						<input type=button name="btn_load_submit" value="Load"
							onclick="javascript:if(confirm('Loading settings will make you to lose all the current settings\nAre you sure ?')) document.frm_load.submit();" />
						<input type=button name="btn_load_cancel" value="Cancel"
							onclick="javascript:document.getElementById('div_load').style.visibility = 'hidden';" />
						<br /><br />
					</td>
				</tr>
			</table>
		</form>
	</div>

	<div id="div_paste" class="greymenu" style="visibility: hidden;">
		<table id="table_paste" border=0 width="100%" class="greymenu">
			<tr align=left
				onclick="document.getElementById('div_paste').style.visibility = 'hidden';func_cut();save_all_form(true);">
				<td>
					&nbsp;Cut
				</td>
			</tr>
			<tr align=left onclick="document.getElementById('div_paste').style.visibility = 'hidden';func_copy();">
				<td>
					&nbsp;Copy
				</td>
			</tr>
			<tr align=left
				onclick="document.getElementById('div_paste').style.visibility = 'hidden';func_paste();save_all_form(true);">
				<td>
					&nbsp;Paste
				</td>
			</tr>
			<tr align=left>
				<th>
					<hr>
				</th>
			</tr>
			<tr align=left>
				<th align=left>
					&nbsp;<b>Paste Wizard</b>
				</th>
			</tr>
			<tr align=left>
				<td>
					&nbsp;Value: <input type="text" id="text_paste" size="8" />
				</td>
			</tr>
			<tr align=left>
				<td>
					&nbsp;Cells:&nbsp;&nbsp;<input type="text" size="3" id="text_paste_size" />
				</td>
			</tr>
			<tr align=left>
				<td>
					&nbsp;Direction:<br />
					<input type=radio id=radio_paste_dir name=radio_paste_dir value="down" checked /> Down<br />
					<input type=radio id=radio_paste_dir name=radio_paste_dir value="rigth" /> Rigth
				</td>
			</tr>
			<tr align=left>
				<td>
					&nbsp;<input type="checkbox" id="checkbox_paste_increase" checked /> Auto increase
				</td>
			</tr>
			<tr align=left>
				<th>
					&nbsp;<input type=button id="btn_paste_submit" value="Paste"
						onclick="document.getElementById('div_paste').style.visibility = 'hidden';func_paste_wizard();save_all_form(true);" />
					<input type=button id="btn_paste_cancel" value="Cancel"
						onclick="javascript:document.getElementById('div_paste').style.visibility = 'hidden';" />
				</th>
			</tr>
		</table>
	</div>

	<div id="div_saving" class="box" style="visibility: hidden;">
		<table border=0 width="100%" class="box">
			<tr align=center>
				<td>
					<br />
					<span style="font-size:5">Saving settings to coockie</span>
					<br /><br />
					Please wait
				</td>
			</tr>
		</table>
	</div>

	<form name="frm_reset" action="<?php print $URI ?>" method="POST">
		<input type=hidden name="todo" value="new" />
	</form>

	<form name="frm_example" action="<?php print $URI ?>" method="POST">
		<input type=hidden name="todo" value="example" />
	</form>

	<?php //print_r($conf); ?>

	<script>
		const tabs = ['General', 'Ports', 'STP', 'Vlans', 'VRRP/HSRP', 'Config'];
		let currentTabIndex = 0;

		function navigateTab(direction) {
			const oldIndex = currentTabIndex;

			if (direction === 'next' && currentTabIndex < tabs.length - 1) {
				currentTabIndex++;
			} else if (direction === 'prev' && currentTabIndex > 0) {
				currentTabIndex--;
			}

			// Update current section text
			document.getElementById('currentSection').textContent = `Section: ${tabs[currentTabIndex]}`;

			// Update button states
			document.getElementById('prevTab').disabled = currentTabIndex === 0;
			document.getElementById('nextTab').disabled = currentTabIndex === tabs.length - 1;

			// Get all tab content divs
			const tabContents = document.getElementsByClassName('tabbertab');

			// Hide all tabs
			for (let i = 0; i < tabContents.length; i++) {
				tabContents[i].style.display = 'none';
			}

			// Show the selected tab
			if (tabContents[currentTabIndex]) {
				tabContents[currentTabIndex].style.display = 'block';
			}
		}

		// Initialize on page load
		window.onload = function () {
			// Initialize button states
			document.getElementById('prevTab').disabled = true;
			document.getElementById('nextTab').disabled = false;

			// Set initial section text
			document.getElementById('currentSection').textContent = `Section: ${tabs[0]}`;

			// Show first tab and hide others
			const tabContents = document.getElementsByClassName('tabbertab');
			for (let i = 0; i < tabContents.length; i++) {
				tabContents[i].style.display = i === 0 ? 'block' : 'none';
			}
		};

		// Auto-growing textarea function
		function initAutoGrowTextareas() {
			const textareas = document.querySelectorAll('.xl textarea');

			function autoGrow(textarea) {
				textarea.style.height = 'auto';
				textarea.style.height = (textarea.scrollHeight) + 'px';
			}

			textareas.forEach(textarea => {
				// Initial size adjustment
				autoGrow(textarea);

				// Add event listeners
				textarea.addEventListener('input', function () {
					autoGrow(this);
				});

				textarea.addEventListener('focus', function () {
					autoGrow(this);
				});
			});
		}

		// Call the function after page load and when switching tabs
		document.addEventListener('DOMContentLoaded', initAutoGrowTextareas);

		// Add to your existing navigateTab function
		const originalNavigateTab = navigateTab;
		navigateTab = function (direction) {
			originalNavigateTab(direction);
			setTimeout(initAutoGrowTextareas, 100); // Re-init after tab switch
		};
	</script>
</body>

</html>