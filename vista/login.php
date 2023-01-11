<?php
class VistaLogin {

    public function login() {
       echo "
        <div class='background'>
            <div id='logo'>
                <i class='fas fa-list logo'></i>
            </div>

            <div class='centered-content'>
                <form id='login' method='POST'>
                    <span class='form-title'>Inicia sesi&oacute;n</span>

                    <label>Nombre de usuario</label>
                    <input type='text' name='user' size='50' placeholder='User name...' />

                    <label>Contrase&ntilde;a</label>
                    <input type='password' name='pass' size='50' placeholder='Password...' />

                    <br/>

                    <span class='form-line'>
                        Mantener sesi&oacute;n abierta&nbsp;
                        <input type='checkbox' name='remember' />
                    </span>

                    <br/>

                    <span class='form-line'>
                        <a href='$home/password'>Olvid&oacute; su contrase&ntilde;a?</a>
                    </span>

                    <span class='actions'>
                        <button><i class='fas fa-sign-in-alt button login'></i></button>
                    </span>
                </form>
            </div>
        </div>
        ";
    }
}      
?>