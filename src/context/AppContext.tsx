import { createContext, useContext, useState, useCallback, ReactNode, useEffect } from 'react';

type Language = 'en' | 'bn';
type Theme = 'light' | 'dark';

interface AppContextType {
  language: Language;
  toggleLanguage: () => void;
  t: (en: string, bn: string) => string;
  theme: Theme;
  toggleTheme: () => void;
  bookingOpen: boolean;
  setBookingOpen: (v: boolean) => void;
}

const AppContext = createContext<AppContextType | undefined>(undefined);

export const AppProvider = ({ children }: { children: ReactNode }) => {
  const [language, setLanguage] = useState<Language>(() => {
    return (localStorage.getItem('lang') as Language) || 'bn';
  });

  const [theme, setTheme] = useState<Theme>(() => {
    return (localStorage.getItem('theme') as Theme) || 'light';
  });

  const [bookingOpen, setBookingOpen] = useState(false);

  useEffect(() => {
    localStorage.setItem('lang', language);
  }, [language]);

  useEffect(() => {
    localStorage.setItem('theme', theme);
    document.documentElement.setAttribute('data-theme', theme);
  }, [theme]);

  const toggleLanguage = useCallback(() => {
    setLanguage(prev => prev === 'en' ? 'bn' : 'en');
  }, []);

  const toggleTheme = useCallback(() => {
    setTheme(prev => prev === 'light' ? 'dark' : 'light');
  }, []);

  const t = useCallback((en: string, bn: string) => language === 'en' ? en : bn, [language]);

  return (
    <AppContext.Provider value={{
      language, toggleLanguage, t,
      theme, toggleTheme,
      bookingOpen, setBookingOpen
    }}>
      {children}
    </AppContext.Provider>
  );
};

export const useApp = () => {
  const ctx = useContext(AppContext);
  if (!ctx) throw new Error('useApp must be inside AppProvider');
  return ctx;
};
