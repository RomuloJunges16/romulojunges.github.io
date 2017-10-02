<?php

//TODO: implementar auto requirimento de classes  
require_once ("treater/requestTreater.php");

//Externaliza o resultado do processamento da API em formato JSON, sempre.

echo((new RequestTreater())->start());
//phpinfo();