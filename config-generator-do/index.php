<?php
// error_reporting (E_ALL ^ E_NOTICE);
include('../include/functions.php');
include("$g_path/vars.php");

$todo = trim($_POST['todo']);

// Add default interface names for different vendors
$juniper_mgmt_int_name = "vme";  // Default management interface name for Juniper
$cisco_mgmt_int_name = "Vlan";   // Default management interface name for Cisco
$nortel_mgmt_int_name = "Vlan";  // Default management interface name for Nortel

if ($todo == "save") {
	$filename = "config-generator-" . date("m.d.y-H.i.s") . "-" . rand(1000000, 10000000) . ".dat";
	//print"<script>alert('".$filename."')</script>;";
	write_ini_file($_POST, "/var/www/temp-saves/$filename");

	header('Location: http://www.example.com/temp-saves/' . $filename);
	exit;
}
date_default_timezone_set('Asia/Jerusalem');


try {
	// Connect to the database using PDO
	$pdo = new PDO("mysql:host=$server_db_host;dbname=config_generator;charset=utf8", $server_db_user, $server_db_password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Unable to connect to database: " . $e->getMessage());
}

// Sanitize inputs securely
$ver = htmlspecialchars(trim($_POST['ver'] ?? ''), ENT_QUOTES, 'UTF-8');
$vendor = htmlspecialchars(trim($_POST['vendor'] ?? ''), ENT_QUOTES, 'UTF-8');

$hostname = escapeshellcmd(trim($_POST['hostname']));
$ip = escapeshellcmd(trim($_POST['ip']));
$subnetmask = escapeshellcmd(trim($_POST['subnetmask']));
$defaultgateway = escapeshellcmd(trim($_POST['defaultgateway']));
$routing_enabled = escapeshellcmd(trim($_POST['routing_enabled']));
$mgmt_vlan = escapeshellcmd(trim($_POST['mgmt_vlan']));
$stack = escapeshellcmd(trim($_POST['stack']));

$stp_mode = escapeshellcmd(trim($_POST['stp_mode']));
$stp_Priority = escapeshellcmd(trim($_POST['stp_Priority']));

$configure_Ports = escapeshellcmd(trim($_POST['configure_Ports']));
$configure_Vlans = escapeshellcmd(trim($_POST['configure_Vlans']));
$configure_VRRP = escapeshellcmd(trim($_POST['configure_VRRP']));


// ==================== Vlans - read ==============================
for ($loop = 1; $loop < 11; $loop++) {
	$v_num[$loop] = escapeshellcmd(trim($_POST["v" . $loop . "_0"]));
	$v_name[$loop] = escapeshellcmd(trim($_POST["v" . $loop . "_1"]));
	$v_ip[$loop] = escapeshellcmd(trim($_POST["v" . $loop . "_2"]));
	$v_mask[$loop] = escapeshellcmd(trim($_POST["v" . $loop . "_3"]));
}

// ==================== VRRP - read ==============================
for ($loop = 1; $loop < 11; $loop++) {

	$v_redundency_vlav[$loop] = escapeshellcmd(trim($_POST["vrrp" . $loop . "_0"]));
	$v_redundency_group[$loop] = escapeshellcmd(trim($_POST["vrrp" . $loop . "_1"]));
	$v_redundency_ip[$loop] = escapeshellcmd(trim($_POST["vrrp" . $loop . "_2"]));
	$v_redundency_priorety[$loop] = escapeshellcmd(trim($_POST["vrrp" . $loop . "_3"]));
	$v_redundency_preemption[$loop] = escapeshellcmd(trim($_POST["vrrp" . $loop . "_4"]));

}

// ==================== Ports - read ==============================
for ($loop = 1; $loop < 49; $loop++) {
	$p_name[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_0"]));
	$p_desc[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_1"]));
	$p_speed[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_2"]));
	$p_duplex[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_3"]));
	$p_vlan[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_4"]));
	$p_tag[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_5"]));
	$p_native_vlan[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_6"]));
	$p_stp_mode[$loop] = escapeshellcmd(trim($_POST["p" . $loop . "_7"]));
}


// $top_comment1 = "This Script was build by ConfigGenerator $ver - an online tool at http://sharontools.com";
// $top_comment2 = "Build date: " . date("F j, Y, g:i a") . "";
// $top_comment3 = "Build for: $vendor";


$query = "select * from commands where vendor='$vendor'";
// Execute the query securely using PDO
$stmt = $pdo->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="robots" content="noindex" />
	<script src="<?php print $g_path_client_side_files ?>/sorttable.js"></script>
</head>

<body bgcolor="white">
	<br />
	<?php
	if (!empty($results)) {
		$comment_tag = $results[0]['comment_tag']; // Fetch the `comment_tag` value from the results
		eval ("\$comment_tag = \"$comment_tag\";");
		// print "<font color=blue>$comment_tag $top_comment1 <br/>$comment_tag $top_comment2 <br/>$comment_tag $top_comment3<br/>$comment_tag<br/></font>";
	
		if ($hostname) {
			$command = $results[0]['hostname']; // Fetch the `hostname` command
			eval ("\$command = \"$command\";");
			print $command . "<br/>";
		}

		if ($ip) {
			if ($stack == "yes") {
				$command = $results[0]['ip_stack']; // Fetch `ip_stack` command
			} else {
				$command = $results[0]['ip']; // Fetch `ip` command
			}
			eval ("\$command = \"$command\";");
			print $command . "<br/>";
		}

		if ($routing_enabled == "no") {
			$command = $results[0]['routing_disabled']; // Fetch `routing_disabled` command
		} else {
			$command = $results[0]['routing_enabled']; // Fetch `routing_enabled` command
		}
		eval ("\$command = \"$command\";");
		print $command . "<br/>";

		if ($defaultgateway) {
			if ($routing_enabled == "no") {
				$command = $results[0]['defaultgateway_routing_d']; // Fetch `defaultgateway_routing_d` command
			} else {
				$command = $results[0]['defaultgateway_routing_e']; // Fetch `defaultgateway_routing_e` command
			}
			eval ("\$command = \"$command\";");
			print $command . "<br/>";
		}

		if ($stp_mode == "rstp") {
			$command = $results[0]['stp_mode_rstp'] . "<br/><font color=red>" . $results[0]['stp_message'] . "</font>"; // Fetch `stp_mode_rstp` and `stp_message`
		} else {
			$command = $results[0]['stp_mode_stp']; // Fetch `stp_mode_stp` command
		}
		eval ("\$command = \"$command\";");
		print $command . "<br/>";

		if ($stp_Priority) {
			$command = $results[0]['stp_priority']; // Fetch `stp_priority` command
			eval ("\$command = \"$command\";");
			print $command . "<br/>";
		}

		if ($configure_Vlans != "no") { // In older saved config files this field was empty
			for ($loop = 1; $loop < 11; $loop++) {
				if (!empty($v_name[$loop])) {
					$command = $results[0]['v_name']; // Fetch `v_name` command
					eval ("\$command = \"$command\";");
					print $command . "<br/>";
				}
			}
		}
	}

	//if ($configure_VRRP!="no"){ // in older saved config files this field was empty // disabled beacuse vlan ip is configured from here..
	// Fetch all results as an associative array using PDO
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Ensure the query returned results
	if (!empty($results)) {
		$command = $results[0]['v_redundency_enable']; // Fetch `v_redundency_enable`
		if ($command) { // If VRRP needs to be enabled globally
			for ($loop = 1; $loop <= 10; $loop++) {
				if (!empty($v_redundency_ip[$loop]) && !empty($v_redundency_group[$loop])) { // Check if VRRP/HSRP is used
					print $command . "<br/>";
					break;
				}
			}
		}

		$message1_shown = "no";
		$v_prefix_mask = $results[0]['v_prefix_mask']; // Fetch `v_prefix_mask`
	
		for ($loop = 1; $loop <= 10; $loop++) {
			if (!empty($v_num[$loop]) && !empty($v_name[$loop]) && !empty($v_ip[$loop]) && !empty($v_mask[$loop])) {
				if ($v_prefix_mask === "yes") { // If needs to convert mask to prefix mask
					$prefix_mask = mask2prefix($v_mask[$loop]);
				}

				$command = $results[0]['v_ip']; // Fetch `v_ip`
				eval ("\$command = \"$command\";");
				print $command . "<br/>";

				$message1 = $results[0]['v_redundency_message']; // Fetch `v_redundency_message`
	
				for ($loop2 = 1; $loop2 <= 10; $loop2++) {
					if (
						!empty($v_num[$loop]) &&
						$v_num[$loop] === ($v_redundency_vlav[$loop2] ?? '') &&
						!empty($v_redundency_ip[$loop2])
					) {
						$command = $results[0]['v_redundency_ip']; // Fetch `v_redundency_ip`
	
						if ($message1 && $message1_shown === "no") {
							$command .= "<br/><font color=red>" . $message1 . "</font>";
							$message1_shown = "yes";
						}

						eval ("\$command = \"$command\";");
						print $command . "<br/>";

						if (!empty($v_redundency_priorety[$loop])) {
							$command = $results[0]['v_redundency_priorety']; // Fetch `v_redundency_priorety`
							eval ("\$command = \"$command\";");
							print $command . "<br/>";
						}

						if (($v_redundency_preemption[$loop2] ?? '') === "y") {
							$command = $results[0]['v_redundency_preemption']; // Fetch `v_redundency_preemption`
							eval ("\$command = \"$command\";");
							print $command . "<br/>";
						}
					}
				}
			}
		}
	}

	//}
	
	if ($configure_Ports != "no") { // In older saved config files this field was empty
		// Fetch all necessary fields from the database
		$p_auto_negotiate_disable = $results[0]['p_auto_negotiate_disable'] ?? '';
		$p_vlan_separator = $results[0]['p_vlan_separator'] ?? '';
		$p_global = $results[0]['p_global'] ?? '';

		if ($p_global) { // If is needed to enter the port name first
			print $p_global . "<br/>";
		}

		for ($loop = 1; $loop < 49; $loop++) {
			$command = $results[0]['p_name'] ?? '';
			if ($command) { // If is needed to enter the port name first
				eval ("\$command = \"$command\";");
				print $command . "<br/>";
			}

			if (!empty($p_desc[$loop])) {
				$command = $results[0]['p_desc'] ?? '';
				eval ("\$command = \"$command\";");
				print $command . "<br/>";
			}

			if ($p_auto_negotiate_disable) { // If needs to disable autonegotiate first
				if ((!empty($p_speed[$loop]) && $p_speed[$loop] != "auto") || (!empty($p_duplex[$loop]) && $p_duplex[$loop] != "auto")) {
					eval ("\$command = \"$p_auto_negotiate_disable\";");
					print $command . "<br/>";
				}
			}

			if (!empty($p_speed[$loop]) && $p_speed[$loop] != "auto") {
				$command = $results[0]['p_speed'] ?? '';
				eval ("\$command = \"$command\";");
				print $command . "<br/>";
			}

			if (!empty($p_duplex[$loop]) && $p_duplex[$loop] != "auto") {
				$command = $results[0]['p_duplex'] ?? '';
				eval ("\$command = \"$command\";");
				print $command . "<br/>";
			}

			if ($vendor != "nortel") { // For nortel it will be configured separately
				if (!empty($p_tag[$loop]) && $p_tag[$loop] == "y") {
					$command = $results[0]['p_tag'] ?? '';
					eval ("\$command = \"$command\";");
					print $command . "<br/>";

					if (!empty($p_vlan[$loop])) {
						$p_vlan[$loop] = str_replace(",", $p_vlan_separator, $p_vlan[$loop]);
						$command = $results[0]['p_vlan_trunk'] ?? '';
						eval ("\$command = \"$command\";");
						print $command . "<br/>";
					}

					if (!empty($p_native_vlan[$loop])) {
						$command = $results[0]['p_native_vlan'] ?? '';
						eval ("\$command = \"$command\";");
						print $command . "<br/>";
					}
				} else {
					if (!empty($p_vlan[$loop])) {
						$command = $results[0]['p_vlan_access'] ?? '';
						eval ("\$command = \"$command\";");
						print $command . "<br/>";
					}
				}
			}

			if (!empty($p_stp_mode[$loop]) && $p_stp_mode[$loop] == "portfast") {
				if ($stp_mode == "rstp") {
					$command = $results[0]['p_stp_mode_rstp'] ?? '';
				} else {
					$command = $results[0]['p_stp_mode_stp'] ?? '';
				}
				eval ("\$command = \"$command\";");
				print $command . "<br/>";
			}
		}

		$p_global_exit = $results[0]['p_global_exit'] ?? '';
		if ($p_global_exit) { // If is needed to enter the port name first
			print $p_global_exit . "<br/>";
		}

		if ($vendor == "nortel") {
			for ($loop = 1; $loop < 49; $loop++) {
				if (!empty($p_vlan[$loop]) || !empty($p_tag[$loop])) {
					if (!empty($p_tag[$loop]) && $p_tag[$loop] == "y") {
						$command = $results[0]['p_tag'] ?? '';
						eval ("\$command = \"$command\";");
						print $command . "<br/>";
					}

					if (!empty($p_vlan[$loop])) {
						$vlans = explode(",", $p_vlan[$loop]);
						foreach ($vlans as $vlan) {
							$command = $results[0]['p_vlan_trunk'] ?? '';
							eval ("\$command = \"$command\";");
							print $command . "<br/>";
						}
					}
				}

				if (!empty($p_native_vlan[$loop])) {
					$command = $results[0]['p_native_vlan'] ?? '';
					eval ("\$command = \"$command\";");
					print $command . "<br/>";
				}
			}
		}
	}
	print "!<font color=blue><br/>! Script end<br/>";
	exit;



	?>