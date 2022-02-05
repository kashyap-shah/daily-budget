function validate(frmName) {
  // variable declare
  const msg = ["<strong><span class='text-danger'>Error:</span></strong>"];

  if (frmName == "frmCredit") {
    let dateCredit = document.forms[frmName]["dateCredit"].value;

    if (
      !dateCredit.match(
        /^(0?[1-9]|[1-2][0-9]|3[01])[\/](0?[1-9]|1[0-2])[\/]\d{4}$/
      )
    ) {
      msg.push(
        '<p><span class="badge bg-danger">Date must be in DD/MM/YYYY format.</span><p>'
      );
    }
  } else if (frmName == "frmDebit") {
    let dateDebit = document.forms[frmName]["dateDebit"].value;

    if (
      !dateDebit.match(
        /^(0?[1-9]|[1-2][0-9]|3[01])[\/](0?[1-9]|1[0-2])[\/]\d{4}$/
      )
    ) {
      msg.push(
        '<p><span class="badge bg-danger">Date must be in DD/MM/YYYY format.</span><p>'
      );
    }
  }
  let summary = document.forms[frmName]["txtSummary"].value;
  let amount = document.forms[frmName]["txtAmount"].value;

  //validation
  if (!amount.match(/^\d+$/)) {
    msg.push(
      '<p><span class="badge bg-danger">Amount should be a number greater than 0.</span><p>'
    );
  }

  if (summary.length < 1) {
    msg.push('<p><span class="badge bg-danger">Summary is Required.</span><p>');
  }

  if (msg.length == 1) {
    return true;
  } else {
    showMsg(msg);
    return false;
  }
}

function showMsg(msg) {
  document.getElementById("msg").innerHTML = msg.join("\n");
}
