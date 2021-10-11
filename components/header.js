const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
    <style>
        #wrapper {
            background-color: #000614;
            margin: auto;
            width: 80%;
            display: flex;
        }
        #menu-bar {
            background-color: #001D3D;
            background-image: linear-gradient(180deg, #001D3D, #000614);
            height: 100px;
            display: flex;
            width: 80%;
            min-width: 1000px;
            margin: auto;
            justify-content: space-around;
            align-items: center;
            text-shadow: #0074fe 0px 0px 19px;
        }
        #navigation-bar {
            font-size: 28px;
            font-weight: 800;
            color: #FFFFFF;
            align-items: center;
        }
        li {
            display: inline;
            letter-spacing: 0.1em;
        }
        a:hover {
            color: #FFC300;
        }
        li a:after {    
          background: none repeat scroll 0 0 transparent;
          bottom: 0;
          content: "";
          display: block;
          height: 2px;
          left: 50%;
          position: absolute;
          transition: width 0.3s ease 0s, left 0.3s ease 0s;
          width: 0;
        }
        li a:hover:after { 
          width: 100%; 
          left: 0; 
        }
        #login-register-section {
            background-color: #001D3D;
            border-style: solid;
            border-color: #FFC300;
            border-width: 1px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: normal;
            font-size: 15px;
            line-height: 30px;
            align-items: center;
            text-align: center;
            height: 30px;
            width: 150px;
        }
        header img {
            left: 50px;
            top: 35px;
            height: 80%;
        }
        header {
            justify-content: space-between;
            background-color: #001D3D;
            background-image: linear-gradient(180deg, #001D3D, #000614);
            }
    </style>
    <header>
        <div id="menu-bar">
            <img src="../img/Screens%20Come%20True.png" alt="Logo">
            <nav>
                <div id="navigation-bar">
                    <ul>
                        <li><a><strong>Movies</strong></a> &nbsp;&nbsp;</li>
                        <li><a><strong>Our Cinemas</strong></a> &nbsp;&nbsp;</li>
                        <li><a><strong>Promotions</strong></a> &nbsp;&nbsp;</li>
                    </ul>
                </div>
            </nav>
            <div id="login-register-section">
                <a href="../pages/login.html?user=login">Log In</a>&nbsp;|&nbsp;<a href="../pages/login.html?user=register">Register</a>
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