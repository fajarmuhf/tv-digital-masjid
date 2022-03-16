
<?php
$bulanMulai=1;
$bulanAkhir=12;
$tahunMulai=2072;
$tahunAkhir=2072;
while($tahunMulai<=$tahunAkhir){
	while(($bulanMulai <= 12 && $tahunMulai != $tahunAkhir) || ($bulanMulai <= $bulanAkhir && $tahunMulai == $tahunAkhir)){
		$bulan=$bulanMulai;
		$tahun = $tahunMulai;
		$folder = "jadwal";

		$url = "https://bimasislam.kemenag.go.id/ajax/getShalatbln";
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = ( array( 
			"x"=> "PNVP8SxTKk11Wg4bjht%2FsE%2FTuu2E%2FH1MLgXFzcGq1%2FTZTvbpE6W%2FZygbgwY%2BjRsfleF4kRl0So%2FTCv5IIrkMIw%3D%3D",
			"y"=>"kW%2BtcPC7yfuM5epynSSIk2%2F3lKGIcTwiLWCQh%2BbfMk6vDL1DEJUZdR9%2F7G6GuI0xJ2G0jW7MeD0bMadmwhvWjg%3D%3D",
			"bln"=>$bulan,
			"thn"=>$tahun 
			) 
			);

		$headers = [
		    'Cookie: PHPSESSID=ve769345u3hbqs1dgm3mra5ab6; ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22db35e5b6c310b84fe108774b586bd7f8%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%22158.140.176.15%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A120%3A%22Mozilla%2F5.0+%28Macintosh%3B+Intel+Mac+OS+X+10_15_7%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F99.0.4844.51+Safari%2F537.36%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1647384650%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D21680b49d54ac263749d5afef041205e'
		];

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);
		# Print response.
		$myfile = fopen($folder."/".$tahun."-".$bulan.".json", "w") or die("Unable to open file!");
		$txt = $result;
		fwrite($myfile, $txt);
		fclose($myfile);
		$bulanMulai++;
	}
	if($bulanMulai>12){
		$bulanMulai = 1;
		$tahunMulai++;
	}
	if($bulanMulai > $bulanAkhir && $tahunMulai == $tahunAkhir){
		return;
	}
}


?>