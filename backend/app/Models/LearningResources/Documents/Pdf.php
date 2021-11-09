<?php

namespace App\Models\LearningResources\Documents;

use App\Models\LearningResources\Document as Document;

class Pdf extends Document {
    public function embed() {
        echo 'a pdf view';
    }
}
