// =============================================================================
// = Wait spinner
// =============================================================================

var waitingForReply=false;
/**
 * ============================================================================
 * Shows a wait spinner
 *
 * @return void
 */
function showWait() {
    if (document.getElementById("wait")) {
        showField("wait");
        waitingForReply=true;
    } else {
        showField("waitLogin");
    }
}

/**
 * ============================================================================
 * Hides a wait spinner
 *
 * @return void
 */
function hideWait() {
    waitingForReply=false;
    hideField("wait");
    hideField("waitLogin");
    if (window.top.document.getElementById("dialogInfo")) {
        window.top.document.getElementById("dialogInfo").style.visibility='hidden';
    }
}

// =============================================================================
// = Generic field visibility properties
// =============================================================================

/**
 * ============================================================================
 * Setup the style properties of a field to set it visible (show it)
 *
 * @param field
 *          the name of the field to be set
 * @return void
 */
function showField(field) {
    var dest = document.getElementById(field);
    if (dest) {
         dest.style.visibility = 'visible';
        dest.style.display = 'inline';
    }
}

/**
 * ============================================================================
 * Setup the style properties of a field to set it invisible (hide it)
 *
 * @param field
 *          the name of the field to be set
 * @return void
 */
function hideField(field) {
    var dest = document.getElementById(field);
    if (dest) {
        dest.style.visibility = 'hidden';
        dest.style.display = 'none';
    }
}
