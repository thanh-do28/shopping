<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>title</td>
                <td>date_time</td>
                <td>checked</td>
                <td>user_id</td>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['array']) && $data['array'] != NULL) {
                foreach ($data['array'] as $key => $val) { ?>
                    <tr>
                        <td><?= $val['id'] ?></td>
                        <td><?= $val['title'] ?></td>
                        <td><?= $val['date_time'] ?></td>
                        <td><?= $val['checked'] ?></td>
                        <td><?= $val['user_id'] ?></td>

                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</body>

</html>