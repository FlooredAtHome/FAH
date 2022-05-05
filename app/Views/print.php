<html>
    <head>
        <title>View</title>
    </head>
    <body>
        <?php if(!empty($users)): ?>
            <?php foreach($users as $user): ?>
                <?= $user->EMAIL; ?>
                <?= $user->PASSWORD; ?>            
            <?php endforeach; ?>
        <?php else: ?>
            <h1>Sorry no record found</h1>
        <?php endif; ?>
    </body>
</html>