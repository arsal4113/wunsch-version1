<p>Itool 3 Error Notification</p>
<br>
<table border="1">
	<tr>
		<td><?= __('Type') ?></td>
		<td><?= __('Code') ?></td>
		<td><?= __('SubCode') ?></td>
		<td><?= __('Message') ?></td>
		<td><?= __('Created') ?></td>
	</tr>
	<?php
		foreach($emailErrors as $emailError) {
			echo "<tr>";
			echo "<td>" . $emailError['type'] . "</td>";
			echo "<td>" . $emailError['code'] . "</td>";
			echo "<td>" . $emailError['sub_code'] . "</td>";
			echo "<td>" . $emailError['message'] . "</td>";
			echo "<td>" . $emailError['created'] . "</td>";
			echo "</tr>";
		}
	?>
</table>