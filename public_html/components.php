<?php
include('header.php');
?>

    <div class = "container">
        <h3>Components List</h3>
        <P> This is the components contents page. Click on the part you are searching for</P>	
    </div>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
}
</style>



<table >
    <tr>
		<td class = "text-center" id="cpucell"><a href="/cpulist">CPU</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="motherboardcell"><a href="/motherboardlist">Motherboard</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="powersupplycell"><a href="/powersupplylist">Power supply</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="ramcell"><a href="/ramlist">RAM</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="casecell"><a href="/caselist">Case</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="gpucell"><a href="/gpulist">GPU</a></td>
	</tr>
	<tr>
		<td class = "text-center" id="memorycell"><a href="/memorylist">Disk Memory</a></td>
	</tr>
    <tr>
        <td class = "text-center" id="coolercell"><a href="/coolerlist">CPU Cooler</a></td>
    </tr>
</table>




<?php
include('footer.php');
?>