import React from "react";

const Footer = () => {
  return (
    <footer className="site-footer bg-dark">
      <div className="footer-widgets">
        <div className="container">
          <div className="row">
            <div className="col-12 col-md-6 col-lg-3">
              <div className="foot-about">
                <a className="foot-logo" href="/">
                  <h2>Yong'oq.uz</h2>
                </a>

                <p>
                  G'ani g'ildirakni g'izillatib g'ildiratdi. G'ani g'ildirakni
                  g'izillatib g'ildiratdi. G'ani g'ildirakni g'izillatib
                  g'ildiratdi. G'ani g'ildirakni g'izillatib g'ildiratdi.
                </p>
              </div>
            </div>

            <div className="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
              <div className="foot-contact">
                <h2>Biz bilan bog'lanish</h2>

                <ul>
                  <li>Email: peterpen983@gmail.com</li>
                  <li>Tel: +998 90 123 45 67</li>
                  <li>Manzil: Guliston shahri</li>
                </ul>
              </div>
            </div>

            <div className="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
              <div className="quick-links flex flex-wrap">
                <h2 className="w-100">Quick Links</h2>

                <ul className="w-50">
                  <li>
                    <a href="/">Biz haqimizda </a>
                  </li>
                  <li>
                    <a href="/">Foydalanish shartlari </a>
                  </li>
                  <li>
                    <a href="/">Xavfsizlik yo'riqnomasi </a>
                  </li>
                  <li>
                    <a href="/">Biz bilan bog'lanish</a>
                  </li>
                </ul>
              </div>
            </div>

            <div className="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
              <div className="follow-us">
                <h2>Obuna bo'ling</h2>

                <ul className="follow-us flex flex-wrap align-items-center">
                  <li>
                    <a href="/">
                      <div className="brand facebook ti ti-facebook"></div>
                    </a>
                  </li>
                  <li>
                    <a href="/">
                      <div className="brand twitter ti ti-twitter"></div>
                    </a>
                  </li>
                  <li>
                    <a href="/">
                      <div className="brand instagram ti ti-instagram"></div>
                    </a>
                  </li>
                  <li>
                    <a href="/">
                      <div className="brand linkedin ti ti-linkedin"></div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
