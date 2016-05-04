function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

// javascript-��� ����������� �� �������
function vote() {
    // (1) ������� ������ ��� ������� � �������
    var req = getXmlHttp()     
    // (2)
    // span ����� � �������
    // � ��� ����� ���������� ��� ����������
    var statusElem = document.getElementById('ajax')
     
    req.onreadystatechange = function() { 
        // onreadystatechange ������������ ��� ��������� ������ �������
        if (req.readyState == 4) {
            // ���� ������ �������� �����������
 
            statusElem.innerHTML = req.statusText // �������� ������ (Not Found, ��..)
 
            if(req.status == 200) {
                 // ���� ������ 200 (��) - ������ ����� ������������
                location.reload()
            }
            // ��� ����� �������� else � ���������� ������ �������
        }
 
    }
 
       // (3) ������ ����� �����������
    req.open('GET', 'save_changes.php', true); 
 
    // ������ ������� �����������: ������ ����� � ������� ������� onreadystatechange
    // ��� ��������� ������ �������
      
    // (4)
    req.send(null);  // �������� ������
   
        // (5)
}
