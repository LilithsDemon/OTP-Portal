<script src="./js/documents.js"></script>
<?php 
  /*
      Documents Page
      - This page provides access to various important documents related to the OTP system.
      - Users can view documents such as the OTP Reference Guide, Card Reader Tracking Sheet, and various check condition cards.
      - Each document is accessible via a button that opens a modal displaying the PDF when clicked.
      
      - As there are currently limited files I see no need to pull these from a database, however if the number of documents increases in the future this may be a better solution.
      - On top of this it might be worth adding a search function if the number of documents increases.
      - This search function could also add filters and pagination if the number of documents increases significantly.
  */


      
  // @summary This function generates a button that, when clicked, opens a modal to display a given PDF document.
  // @param string $cardTitle The title to be displayed on the button.
  // @param string $cardText The descriptive text to be displayed on the button.
  // @param string $pdfPath The file path to the PDF document to be displayed.
  function LoadDocumentButtons($cardTitle, $cardText, $pdfPath){
    ?>
      
        <button type="button" class="card w-100 load_doc_btn" data-bs-toggle="modal" data-pdf-path="<?php echo $pdfPath?>" data-bs-target="#staticBackdrop">
            <div class="card-body">
                <h5 class="card-title"><?php echo $cardTitle ?></h5>
                <p class="card-text"><?php echo $cardText?></p>
            </div>
        </button>
    <?
  }
?>

<h1 class="text-center">Documents</h1>

<div class="d-flex mt-4 pb-4 justify-content-center align-items-center flex-column gap-4">
    <?php
    LoadDocumentButtons("OTP Reference Guide", "Click to view the OTP Reference Guide.", "./Assets/Documents/OTP-Reference-Guide.pdf");
    LoadDocumentButtons("Card Reader Tracking Sheet", "Click to view the Card Reader Serial Number tracking sheet","./Assets/Documents/Card-Reader-tracking-sheet.pdf");
    LoadDocumentButtons("Label3 Cleaning Card", "Click to view the new MC Label3 Cleaning Card","./Assets/Documents/MC-Label3-Cleaning-Card-V2.pdf");
    LoadDocumentButtons("PS232 - Till Check Card", "Click to view the Till System Check Condition Card","./Assets/Documents/PS232-Till-System-Check-Condition.pdf");
    LoadDocumentButtons("PS233 - Card Reader Security Check Card","Click to view the Till System Check Condition Card","./Assets/Documents/PS233-Card-Reader-Security-Check.pdf");
    LoadDocumentButtons("PS234 - Office PC Check Condition Card", "Click to view the Office PC Check Condition Card","./Assets/Documents/PS234-Office-PC-Check-Condition.pdf");
    LoadDocumentButtons("PS235 - COD Check Condition Card", "Click to view the COD Check Condition Card","./Assets/Documents/PS235-COD-Check-Condition.pdf");
    LoadDocumentButtons("PS236 - 3M Headset Check Condition Card", "Click to view the 3M Check Condition Card","./Assets/Documents/PS236-3M-Headset-Check-Condition.pdf");
    ?>
</div>

<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex">
        <iframe id="doc_modal" src="" class="w-100 rounded"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>