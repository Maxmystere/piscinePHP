#!/usr/bin/php
<?PHP
$line = true;
while ($line != $EOF)
{
    print("Entrez un nombre: ");
    $handle = fopen("php://stdin","r");
    $line = (fgets($handle));
    $read = trim($line);
    if ($read != $EOF)
    {
        if (is_numeric($read))
        {
            if (intval($read) % 2)
            {
                print("Le chiffre $read est Impair\n");
            }
            else
            {
                print("Le chiffre $read est Pair\n");
            }
        }
        else
        {
            print("'$read' n'est pas un chiffre\n");
        }
    }
    fclose($handle);
}
?>
