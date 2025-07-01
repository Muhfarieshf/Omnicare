<?php
/**
 * Print Layout
 * For print-friendly pages
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <style>
        /* Print-specific styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 14px;
            line-height: 1.4;
        }
        
        @media print {
            body { margin: 0; padding: 15px; }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
        
        @media screen {
            body { background: #f5f5f5; }
            .print-container { 
                background: white; 
                max-width: 800px; 
                margin: 20px auto; 
                padding: 40px; 
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="print-container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>