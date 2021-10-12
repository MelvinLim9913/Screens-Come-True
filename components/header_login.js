const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
    <style>
        #menu-bar {
            background-color: #000000;
            height: 100px;
            display: flex;
            width: 65%;
            min-width: 1000px;
            margin: 0 auto;
            justify-content: space-between;
            align-items: center;
        }
        #navigation-bar {
            font-size: 24px;
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
            font-size: 20px;
            line-height: 40px;
            align-items: center;
            text-align: center;
            height: 40px;
            width: 180px;
        }
        header img {
            left: 50px;
            top: 35px;
        }
        header {
            justify-content: space-between;
            background-color: #000000;
        }
    </style>
    <header>
        <div id="menu-bar">
            <img src="../img/header_title.png" width="225" height="101" alt="Logo">
            <a href="#" onclick="javascript:window.history.back(-1);return false;"><img src="../img/login_cancel.svg" width="120" height="40" alt="Logo"></a>
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