import './App.css';
import "bootstrap/dist/css/bootstrap.min.css";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./components/Home";
import Boxes from "./components/Boxes";
import Footer from "./components/Footer";
import Tests from "./pages/Tests";
import News from "./pages/News";
import AboutUs from "./pages/AboutUs";
import Contact from "./pages/Contact";


function App() {
  return (
    <div className="App">
      <Router>
        <Home />
        <Routes>
          <Route path="/tests" exact element={<Tests />} />
          <Route path="/news" exact element={<News />} />
          <Route path="/about_us" exact element={<AboutUs />} />
          <Route path="/contact" exact element={<Contact />} />
        </Routes>
        <Boxes />
        <Footer />
      </Router>
    </div>
  );
}

export default App;
