const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
    <style>
        #menu-bar {
            background-color: #000000;
            height: 100px;
            display: flex;
            width: 80%;
            min-width: 1000px;
            margin: 0 auto;
            justify-content: space-between;
            align-items: center;
        }
        #navigation-bar {
            font-size: 20px;
            font-weight: 800;
            color: #FFFFFF;
            align-items: center;
        }
        ul {
            font-family: Tahoma, Trebuchet MS;
            letter-spacing: 0.05em;
            display: flex;
            justify-content: center;
            list-style-type: none;
        }
        li {
            margin-right: 60px;
        }
        a:hover {
            color: #EA2127;
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }
        a {
            text-decoration: none;
            color: #FFFFFF;
            font-weight: bold;
        }
        .login {
            font-weight: normal;
            transition: 0.3s all ease-in-out;
        }
        li a {
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in-out;
        }
        li a:after {    
          content: '';
          width: 0;
          height: 2px;
          background-color: #FFFFFF;
          margin: auto;
          display: block;
          transition: 0.3s all ease-in-out;
        }
        li a:hover:after { 
          width: 28px; 
          transition: width 0.3s ease-in-out;
        }
        #login-register-section {
            background-color: #000000;
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 40px;
            align-items: center;
            text-align: center;
            height: 40px;
            width: 180px;
        }
        header img {
            left: 50px;
            top: 35px;
            height: 80%;
            width: 250px;
            height: 100px;
            text-align: left;
            float: left;
        }
        header {
            justify-content: space-between;
            background-color: #000000;
            background-image: linear-gradient(180deg, #000000, #000000);
            }
    </style>
    <header>
        <div id="menu-bar">
            <img src="../img/title.png" alt="Logo">
            <nav>
                <div id="navigation-bar">
                    <ul>
                        <li><a><strong>Movies</strong></a></li>
                        <li><a><strong>Our Cinemas</strong></a></li>
                        <li><a><strong>Promotions</strong></a></li>
                    </ul>
                </div>
            </nav>
            <div id="login-register-section">
                <a class="login" href="../pages/login.html?user=login">Log In</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="login" href="../pages/login.html?user=register">Register</a>
            </div>            
        </div>
    </header>
    `;

class Header extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "closed" });
        shadowRoot.appendChild(headerTemplate.content);
    }
}

customElements.define('header-component', Header);