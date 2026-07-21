Add-Type -AssemblyName System.Drawing
$images = @(
    "public\pictures\design\Label on the back.png",
    "public\pictures\design\Label on the back p1.png",
    "public\pictures\design\INSEAM LOOP LABLE.png",
    "public\pictures\design\Inseam loop label p1.png"
)

foreach ($imgPath in $images) {
    $fullPath = Join-Path (Get-Location) $imgPath
    if (-Not (Test-Path $fullPath)) {
        Write-Output "Not found: $imgPath"
        continue
    }
    
    $bmp = New-Object System.Drawing.Bitmap $fullPath
    $w = $bmp.Width
    $h = $bmp.Height
    
    $minX = $w
    $maxX = 0
    $minY = $h
    $maxY = 0
    $found = $false
    
    for ($y = 0; $y -lt $h; $y++) {
        for ($x = 0; $x -lt $w; $x++) {
            $color = $bmp.GetPixel($x, $y)
            # Find dark pixels
            if ($color.R -lt 50 -and $color.G -lt 50 -and $color.B -lt 50 -and $color.A -gt 200) {
                # Check for a 6x6 block of dark pixels to ensure it's a filled rectangle and not a line
                $isBlock = $true
                if ($x + 5 -lt $w -and $y + 5 -lt $h) {
                    for ($dy = 0; $dy -lt 6; $dy++) {
                        for ($dx = 0; $dx -lt 6; $dx++) {
                            $c = $bmp.GetPixel($x+$dx, $y+$dy)
                            if ($c.R -gt 50 -or $c.A -lt 100) {
                                $isBlock = $false
                                break
                            }
                        }
                        if (-Not $isBlock) { break }
                    }
                } else {
                    $isBlock = $false
                }
                
                if ($isBlock) {
                    $found = $true
                    if ($x -lt $minX) { $minX = $x }
                    if ($x -gt $maxX) { $maxX = $x }
                    if ($y -lt $minY) { $minY = $y }
                    if ($y -gt $maxY) { $maxY = $y }
                }
            }
        }
    }
    
    if ($found) {
        $maxX += 5
        $maxY += 5
        $rectW = $maxX - $minX
        $rectH = $maxY - $minY
        
        $leftPct = [math]::Round(($minX / $w) * 100, 2)
        $topPct = [math]::Round(($minY / $h) * 100, 2)
        $widthPct = [math]::Round(($rectW / $w) * 100, 2)
        $heightPct = [math]::Round(($rectH / $h) * 100, 2)
        
        Write-Output "$imgPath : left=$leftPct%, top=$topPct%, width=$widthPct%, height=$heightPct%"
    } else {
        Write-Output "$imgPath : No block found"
    }
    $bmp.Dispose()
}
