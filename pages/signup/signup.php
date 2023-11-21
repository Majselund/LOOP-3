<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tilmelding</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <?php include('../../components/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>Tilmelding til innovationsdagene</h1>
        <div id="main" class="content container mx-auto prose">
            <form action="process-signup.php" method="POST">
                <label for="uddannelsessted">Uddannelsessted</label><br>
                <input type="text" name="uddannelsessted" required="" placeholder="Indsæt her">
                <label for="antal_elever">Antal Elever</label><br>
                <input type="number" name="antal_elever" required="" placeholder="Indsæt her">
                <label for="kontaktperson">Kontaktperson</label><br>
                <input type="text" name="kontaktperson" required="" placeholder="Indsæt her">
                <label for="telefonnummer">Telefonnummer</label><br>
                <input type="number" name="telefonnummer" required="" placeholder="Indsæt her">
                <label for="emailadresse">E-mailadresse</label><br>
                <input type="text" name="emailadresse" required="" placeholder="Indsæt her">
                <label class="flex">
                    <input type="checkbox" name="terms" required="">
                    <p>
                        Jeg ønsker at modtage information om Innovations<strong>dag</strong>. Jeg accepterer at blive kontaktet via mail eller telefon.
                    </p>
                </label> 
                <input type="submit" value="SUBMIT"><br>
            </form>
        </div>
    </div>
    </main>
    <?php include('../../components/footer.php') ?>
</body>
</html>