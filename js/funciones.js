// Checkear todos
function todos( frm )
{
	// frm = document.excExp;
    if( frm.check_todos.checked )
    {
        if( typeof frm.check_uno.length != "undefined" )
        {
            for ( i = 0; i < frm.check_uno.length; i++ )
            {
                frm.check_uno[i].checked = true;
            }
        }
        else
        {
            frm.check_uno.checked = true;
        }
    }
    else
    {
        if( typeof frm.check_uno.length != "undefined" )
        {
            for ( i = 0; i < frm.check_uno.length; i++ )
            {
                frm.check_uno[i].checked = false;
            }
        }
        else
        {
            frm.check_uno.checked = false;
        }
    }
}

// Checkea uno
function uno( frm )
{
    var verificacion = false;
    // frm = document.excExp;
    if( typeof frm.check_uno.length != "undefined" )
    {
        for ( i = 0; i < frm.check_uno.length; i++ )
        {
            if ( frm.check_uno[i].checked == false )
            {
                verificacion = true
                break;
            }
        }
    }
    else
    {
        if ( frm.check_uno.checked == false )
        {
            verificacion = true
        }
    }

    if( verificacion )
	{
		frm.check_todos.checked = false;
	}
    else
	{
		frm.check_todos.checked = true;
	}
}