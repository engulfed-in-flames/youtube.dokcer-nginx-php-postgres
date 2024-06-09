<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  Homepage
  <hr />
  <div>
    <?php if ($invoice ?? null) : ?>
      <h2>Invoice</h2>
      Invoice ID: <?= htmlspecialchars($invoice["id"], ENT_QUOTES) ?>
      Amount: <?= htmlspecialchars($invoice["amount"], ENT_QUOTES) ?>
      User: <?= htmlspecialchars($invoice["full_name"], ENT_QUOTES) ?>
    <?php endif ?>
  </div>
</body>

</html>