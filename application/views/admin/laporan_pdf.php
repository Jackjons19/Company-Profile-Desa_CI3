<!DOCTYPE html>
<html><head>
    <title></title>
</head><body>
            <table>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Pesan</th>
                </tr>

                <?php 
                $i = 1;
                foreach($pesan as $psn) :
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $psn->nama; ?></td>
                  <td><?php echo word_limiter($psn->pesan, 1); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
</body></html>