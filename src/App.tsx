import { useState } from 'react';
import { AppProvider } from './context/AppContext';
import Navbar from './components/Navbar';
import HeroSection from './components/HeroSection';
import ServicesSection from './components/ServicesSection';
import ReviewsSection from './components/ReviewsSection';
import ContactSection from './components/ContactSection';
import Footer from './components/Footer';
import BookingDialog from './components/BookingDialog';
import AdminDashboard from './pages/AdminDashboard';

type Page = 'home' | 'admin';

function HomePage() {
  return (
    <main>
      <HeroSection />
      <ServicesSection />
      <ReviewsSection />
      <ContactSection />
      <Footer />
    </main>
  );
}

function App() {
  const [activePage, setActivePage] = useState<Page>('home');

  return (
    <AppProvider>
      <div className="app-container" style={{ minHeight: '100vh' }}>
        <Navbar activePage={activePage} setActivePage={setActivePage} />
        {activePage === 'home' ? (
          <HomePage />
        ) : (
          <AdminDashboard onBack={() => setActivePage('home')} />
        )}
        <BookingDialog />
      </div>
    </AppProvider>
  );
}

export default App;
