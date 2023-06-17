import React from 'react';
import { Container, Row, Card } from "react-bootstrap";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faAtom, faChartLine, faTachometerFast } from "@fortawesome/free-solid-svg-icons";

const Sciences = () => {
  return (
    // <section className="home-gallery">
    //   <div className="gallery-wrap flex flex-wrap">
    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/a.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/b.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid2x2">
    //       <a href="/">
    //         <img src="../../images/c.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/d.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/e.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid2x1">
    //       <a href="/">
    //         <img src="../../images/g.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid2x1">
    //       <a href="/">
    //         <img src="../../images/h.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/i.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid2x2 ">
    //       <a href="/">
    //         <img src="../../images/j.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/k.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../../images/l.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid2x1">
    //       <a href="/">
    //         <img src="../../images/m.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid3x1">
    //       <a href="/">
    //         <img src="../../images/n.jpg" alt="" />
    //       </a>
    //     </div>

    //     <div className="gallery-grid gallery-grid1x1">
    //       <a href="/">
    //         <img src="../images/o.jpg" alt="" />
    //       </a>
    //     </div>
    //   </div>
    // </section>

    // <Container className="p-4">
    //   <Row>
    //     {[
    //       "Success",
    //       "Primary",
    //       "Warning",
    //       "Success",
    //       "Primary",
    //       "Success",
    //       "Danger",
    //       "Info",
    //       "Info",
    //       "Danger",
    //       "Primary",
    //       "Warning",
    //     ].map((variant, idx) => (
    //       <Card
    //         bg={variant.toLowerCase()}
    //         key={idx}
    //         text={variant.toLowerCase() === "light" ? "dark" : "white"}
    //         style={{ width: "300px", height: "300px" }}
    //         className="card m-2"
    //       >
    //       {[
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />,
    //         <FontAwesomeIcon icon={faAtom} />
    //       ].map((icon, idx)=>(
    //         // <Card.Header>{icon}</Card.Header>
    //         <Card.Title>{icon}</Card.Title>
    //       ))}
    //         <Card.Body>
    //           {/* <Card.Title>{variant} Card Variant </Card.Title> */}
    //         </Card.Body>
    //       </Card>
    //     ))}
    //   </Row>
    // </Container>
    
    <div className="container p-4">
      <div className="row d-flex justify-content-center">
        <div
          className="card m-2 p-2 bg-danger"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Kimyo</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-success"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Matematika</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-primary"
          style={{ width: "40%" }}
        >
          <div className="card-warning">
            <h1>Tarix</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-warning"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Ingliz tili</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-danger"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Geografiya</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-success"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>O'zbek tili va adabiyoti</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-info"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Fizika</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-primary"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Rus tili</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-danger"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Nemis tili</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-warning"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Fransuz tili</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-info"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Informatika</h1>
          </div>
        </div>
        <div
          className="card m-2 p-2 bg-success"
          style={{ width: "40%" }}
        >
          <div className="card-text">
            <h1>Huquqiy bilim asoslari</h1>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Sciences
