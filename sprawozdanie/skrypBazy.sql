USE [Nowa]
GO
/****** Object:  Table [dbo].[AdresLadunku]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[AdresLadunku](
	[IdAdresLadunku] [int] NOT NULL,
	[Ulica] [varchar](100) NULL,
	[Miejscowosc] [varchar](100) NOT NULL CONSTRAINT [DF_AdresLadunku_Miejscowowsc]  DEFAULT ('Kalisz'),
	[KodPocztowy] [char](6) NOT NULL,
	[NrDomu] [varchar](10) NOT NULL,
	[NrBudynku] [varchar](10) NULL,
	[Poczta] [varchar](100) NULL,
	[InfoDodatkowe] [varchar](200) NULL,
	[NrHangaru] [varchar](10) NULL,
	[NrBoxu] [varchar](10) NULL,
 CONSTRAINT [PK_AdresLadunku] PRIMARY KEY CLUSTERED 
(
	[IdAdresLadunku] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Kategoria]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Kategoria](
	[IdKategoria] [int] NOT NULL,
	[Kategoria] [varchar](50) NOT NULL,
	[PodKategoria] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Kategoria] PRIMARY KEY CLUSTERED 
(
	[IdKategoria] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Klient]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Klient](
	[IdKlient] [int] IDENTITY(1,1) NOT NULL,
	[Imie] [varchar](50) NOT NULL,
	[Ulica] [varchar](100) NOT NULL,
	[Miejscowosc] [varchar](100) NOT NULL CONSTRAINT [DF_Klient_Miejscowowsc]  DEFAULT ('Kalisz'),
	[NrDomu] [varchar](10) NOT NULL,
	[NrBudynku] [varchar](10) NULL,
	[KodPocztowy] [char](6) NOT NULL,
	[Poczta] [varchar](100) NULL,
	[NrTelefonu] [varchar](20) NOT NULL CONSTRAINT [DF_Klient_NrTelefonu]  DEFAULT ((((48)-(777))-(777))-(777)),
	[Email] [varchar](100) NULL,
	[Pesel] [int] NULL,
	[Nip] [int] NULL,
	[Regon] [int] NULL,
	[Fax] [varchar](50) NULL,
 CONSTRAINT [PK_Klient] PRIMARY KEY CLUSTERED 
(
	[IdKlient] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Ladunek]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Ladunek](
	[IdLadunek] [int] IDENTITY(1,1) NOT NULL,
	[IdZamowienia] [int] NOT NULL,
	[RodzajLadunku] [varchar](50) NOT NULL,
	[MasaLadunkuKG] [int] NOT NULL,
	[LiczbaSztukLadunku] [int] NULL,
	[IdAdresStartowyLadunku] [int] NOT NULL,
	[IdAdresDocelowyLadunku] [int] NOT NULL,
	[IdKategoria] [int] NOT NULL,
	[IdPojazd] [int] NOT NULL,
	[IdNaczepa] [int] NOT NULL,
	[IdKierowcy] [int] NOT NULL,
	[UszkodzeniaWProc] [int] NULL,
	[Podliczone] [int] NULL,
 CONSTRAINT [PK_Ladunek] PRIMARY KEY CLUSTERED 
(
	[IdLadunek] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Naczepa]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Naczepa](
	[IdNaczepa] [int] NOT NULL,
	[NazwaNaczepa] [varchar](50) NOT NULL,
	[RodzajNaczepa] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Naczepa] PRIMARY KEY CLUSTERED 
(
	[IdNaczepa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Pojazd]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pojazd](
	[IdPojazdu] [int] NOT NULL,
	[NazwaPojazdu] [varchar](50) NOT NULL,
	[NrRejestracyjny] [char](10) NOT NULL,
	[NrVIN] [char](30) NOT NULL,
	[MarkaPojazdu] [varchar](30) NOT NULL,
	[Model] [varchar](30) NOT NULL,
	[RokProdukcji] [date] NOT NULL,
 CONSTRAINT [PK_Pojazd] PRIMARY KEY CLUSTERED 
(
	[IdPojazdu] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Pracownik]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pracownik](
	[Imie] [varchar](50) NOT NULL,
	[Nazwisko] [varchar](100) NOT NULL,
	[NrTelefonu] [varchar](20) NOT NULL,
	[Email] [varchar](100) NOT NULL,
	[Stanowisko] [varchar](50) NOT NULL,
	[IdPracownika] [int] NOT NULL,
	[Licencja] [varchar](50) NULL,
	[Aktywny] [int] NULL,
	[Zdjecie] [varchar](50) NULL,
 CONSTRAINT [PK_Pracownik] PRIMARY KEY CLUSTERED 
(
	[IdPracownika] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Pracownik_Archiwum]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pracownik_Archiwum](
	[Imie] [varchar](50) NOT NULL,
	[Nazwisko] [varchar](100) NOT NULL,
	[NrTelefonu] [varchar](20) NOT NULL,
	[Email] [varchar](100) NOT NULL,
	[Stanowisko] [varchar](50) NOT NULL,
	[IdPracownika] [int] NOT NULL,
	[Licencja] [varchar](50) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Uzytkownik]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Uzytkownik](
	[IdUzytkownik] [int] IDENTITY(1,1) NOT NULL,
	[Login] [varchar](20) NOT NULL,
	[Haslo] [varchar](40) NOT NULL,
	[DataRejestracji] [datetime] NOT NULL,
	[IdKlient] [int] NULL,
	[IdPracownik] [int] NULL,
 CONSTRAINT [PK_Uzytkownik] PRIMARY KEY CLUSTERED 
(
	[IdUzytkownik] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Zamowienie]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Zamowienie](
	[IdZamowienia] [int] IDENTITY(1,1) NOT NULL,
	[IdKlient] [int] NOT NULL,
	[OdlegloscKM] [int] NOT NULL,
	[Cena] [money] NOT NULL CONSTRAINT [DF_Cena]  DEFAULT ((0)),
	[Uwagi] [varchar](200) NULL,
	[DataZlozenia] [date] NOT NULL CONSTRAINT [DF_Zamowienie_DataZlozenia]  DEFAULT (getdate()),
	[DataRealizacji] [date] NULL,
	[TreminRealizacji] [date] NOT NULL,
	[Opoznienie] [date] NULL,
	[DataOdbioruLadunku] [date] NOT NULL CONSTRAINT [DF_Zamowienie_DataOdbioruLadunku]  DEFAULT (getdate()),
	[IdSpedytor] [int] NULL,
 CONSTRAINT [PK_Zamowienia] PRIMARY KEY CLUSTERED 
(
	[IdZamowienia] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (1, N'Zmieniony', N'Liskow', N'62-850', N'2', N'1', N'Liskow', N'Zajazd od polodnia', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (2, N'Polna', N'Liskow', N'62-850', N'4', N'1', N'Liskow', N'Zajazd od polnocy', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (4, N'Sloneczka', N'Liskow', N'62-850', N'4', N'8', N'Liskow', N'', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (5, N'Majestatyczna', N'Liskow', N'62-850', N'11A', N'3', N'Liskow', N'Dzwonic', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (6, N'Kwaitowa', N'Kalisz', N'62-850', N'2', N'1', N'Kalisz', N'Zajazd od polodnia', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (7, N'Polna', N'Kalisz', N'62-800', N'4', N'1', N'Kalisz', N'Zajazd od polnocy', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (8, N'Wodna', N'Kalisz', N'62-800', N'2', N'3', N'Kalisz', N'', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (9, N'Sloneczka', N'Kalisz', N'62-800', N'4', N'8', N'Kalisz', N'', N'', N'')
INSERT [dbo].[AdresLadunku] ([IdAdresLadunku], [Ulica], [Miejscowosc], [KodPocztowy], [NrDomu], [NrBudynku], [Poczta], [InfoDodatkowe], [NrHangaru], [NrBoxu]) VALUES (10, N'Majestatyczna', N'Kalisz', N'62-800', N'11A', N'3', N'Kalisz', N'Dzwonic', N'', N'')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (1, N'Zmieniona', N'Niemcy')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (2, N'Miedzynarodowe', N'Czechy')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (4, N'Miedzynarodowe', N'Ukraina')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (5, N'Miedzynarodowe', N'Rosja')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (6, N'Miedzynarodowe', N'Francja')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (7, N'Miedzynarodowe', N'Hiszpania')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (8, N'Miedzynarodowe', N'Anglia')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (9, N'Miedzynarodowe', N'Bialorus')
INSERT [dbo].[Kategoria] ([IdKategoria], [Kategoria], [PodKategoria]) VALUES (10, N'Krajowe', N'Polska')
SET IDENTITY_INSERT [dbo].[Klient] ON 

INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (1, N'Zmieniony', N'Kwiatowa', N'Liskow', N'1', N'2', N'62-850', N'Liskow', N'48-778-896-854', N'JarekZLiskowa@gmail.com', 784512241, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (2, N'Pawel', N'Sloneczna', N'Liskow', N'4', N'1', N'62-850', N'Liskow', N'48-718-896-554', N'PawelZLiskowa@gmail.com', 184511141, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (4, N'Zbyszek', N'Wodna', N'Liskow', N'2A', N'1', N'62-850', N'Liskow', N'48-998-996-854', N'ZbyszkoZLiskowa@gmail.com', 294412819, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (5, N'Nepomucen', N'Majestatyczna', N'Liskow', N'1', N'2', N'62-850', N'Liskow', N'48-178-111-854', N'NepomucenZLiskowa@gmail.com', 111512241, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (6, N'Jarek', N'Kwiatowa', N'Kalisz', N'1', N'2', N'62-800', N'Kalisz', N'48-728-896-854', N'JarekZLiskowa@gmail.com', 584512242, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (7, N'Pawel', N'Sloneczna', N'Kalisz', N'4', N'1', N'62-800', N'Kalisz', N'48-711-896-554', N'PawelZLiskowa@gmail.com', 884511142, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (8, N'Maciej', N'Polna', N'Kalisz', N'5', N'11', N'62-800', N'Kalisz', N'48-178-895-111', N'MaciejZLiskowa@gmail.com', 984514582, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (9, N'Zbyszek', N'Wodna', N'Kalisz', N'2A', N'1', N'62-800', N'Kalisz', N'48-988-996-854', N'ZbyszkoZLiskowa@gmail.com', 194412812, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (10, N'Nepomucen', N'Majestatyczna', N'Kalisz', N'1', N'2', N'62-800', N'Kalisz', N'48-178-111-854', N'NepomucenZLiskowa@gmail.com', 811512243, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (11, N'imie', N'ulica', N'miejscowowsc', N'2', N'1', N'62-850', N'miejscowosc', N'48-789-865-654', N'maciej@maciej.pl', 123456779, 0, 0, N'0')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (12, N'imie', N'ulica', N'miejscowowsc', N'2', N'1', N'62-850', N'miejscowosc', N'48-789-865-654', N'maciej@maciej.pl', 123456779, 0, 0, N'0')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (13, N'piotr', N'piotrkowska', N'piotrowo', N'1', N'', N'62-850', N'', N'48-789-865-111', N'', 0, 0, 0, N'')
INSERT [dbo].[Klient] ([IdKlient], [Imie], [Ulica], [Miejscowosc], [NrDomu], [NrBudynku], [KodPocztowy], [Poczta], [NrTelefonu], [Email], [Pesel], [Nip], [Regon], [Fax]) VALUES (14, N'Pawel', N'Pawlowo', N'pawlisko', N'1', N'', N'62-850', N'', N'48-789-825-654', N'', 0, 0, 0, N'')
SET IDENTITY_INSERT [dbo].[Klient] OFF
SET IDENTITY_INSERT [dbo].[Ladunek] ON 

INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (2, 2, N'adwad', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (4, 4, N'Bloto', 10, 1, 4, 5, 4, 4, 4, 4, 0, 1)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (5, 5, N'SzkloZWoda', 10, 1, 5, 6, 5, 5, 5, 5, 0, 1)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (9, 9, N'Spirytus', 1000, 1, 9, 10, 9, 9, 9, 9, 0, 1)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (654, 666, N'maslo', 412, 12, 6, 10, 8, 8, 5, 8, 2, 0)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (655, 666, N'Piasek', 20, 1, 6, 1, 10, 6, 10, 9, 0, 0)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (656, 666, N'Szklo', 20, 1, 6, 1, 2, 4, 9, 9, 0, 0)
INSERT [dbo].[Ladunek] ([IdLadunek], [IdZamowienia], [RodzajLadunku], [MasaLadunkuKG], [LiczbaSztukLadunku], [IdAdresStartowyLadunku], [IdAdresDocelowyLadunku], [IdKategoria], [IdPojazd], [IdNaczepa], [IdKierowcy], [UszkodzeniaWProc], [Podliczone]) VALUES (658, 667, N'czekloada', 20, 1, 8, 9, 10, 8, 9, 9, 0, 0)
SET IDENTITY_INSERT [dbo].[Ladunek] OFF
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (1, N'Zmieniona', N'Wywrotka')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (2, N'Stanislaw', N'Wywrotka')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (4, N'Marta', N'Wywrotka')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (5, N'Pawel', N'Przyczepa')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (6, N'Bartek', N'HermetycznaCysterna')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (7, N'Cykoria', N'HermetycznaCysterna')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (8, N'KolegaZbyszka', N'HermetycznaCysterna')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (9, N'Sasha', N'HermetycznaCysterna')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (10, N'Sergiej', N'Wywrotka')
INSERT [dbo].[Naczepa] ([IdNaczepa], [NazwaNaczepa], [RodzajNaczepa]) VALUES (11, N'Lucyna', N'Przyczepa')
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (1, N'Zmieniony', N'PKS 558   ', N'546a54w6d5                    ', N'Scania', N'Nieznany', CAST(N'1999-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (2, N'ZoltyKwadrat', N'PKS 258   ', N'4411a54w6d5                   ', N'Scania', N'Nieznany', CAST(N'1998-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (4, N'StatekKosmiczny', N'KKA 554   ', N'dwad211                       ', N'Mercedes', N'Nieznany', CAST(N'1982-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (5, N'Satelita', N'KSA 554   ', N'dwa891                        ', N'Mercedes', N'Nieznany', CAST(N'1982-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (6, N'Czerowny', N'PKS 888   ', N'546a4w6d5                     ', N'Scania', N'Nieznany', CAST(N'1999-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (7, N'Zolty', N'PKS 218   ', N'4411a546d5                    ', N'Scania', N'Nieznany', CAST(N'1998-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (8, N'Waz', N'PKS 122   ', N's25a54w6d5                    ', N'Mercedes', N'Nieznany', CAST(N'1972-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (9, N'Statek', N'KDA 554   ', N'dwad11                        ', N'Mercedes', N'Nieznany', CAST(N'1992-11-23' AS Date))
INSERT [dbo].[Pojazd] ([IdPojazdu], [NazwaPojazdu], [NrRejestracyjny], [NrVIN], [MarkaPojazdu], [Model], [RokProdukcji]) VALUES (10, N'Rakieta', N'ASA 554   ', N'dwd211                        ', N'Mercedes', N'Nieznany', CAST(N'1922-11-23' AS Date))
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Zmieniony', N'Nudny', N'48-666-111-222', N'zbyszeknudny@nud.n', N'Kierowca', 1, N'brak', 1, N'')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Jadwiga', N'Kwasniewski', N'48-112-111-222', N'jadwiganudny@nud.n', N'Kierowca', 2, N'123512463', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Wojtek', N'Tak', N'48-221-111-222', N'Wojtekszeknudny@nud.n', N'Kierowca', 4, N'21d12d12', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Karyna', N'Russian', N'48-991-111-222', N'karyna231ny@nud.n', N'Kierowca', 5, N'bdawdasd', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Brajanek', N'Skrzywdzowny', N'48-781-111-222', N'brajszyk@nud.n', N'Kierowca', 6, N'b123123k', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Bezimienny', N'Bezimienny', N'48-451-111-222', N'bezik@nud.n', N'Kierowca', 7, N'bradasdak', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Sauron', N'SlugaPiekiel', N'48-147-111-222', N'SAURON@nud.n', N'Kierowca', 8, N'b123123asdak', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Melkor', N'WladcaPiekiel', N'48-789-111-222', N'MELKORBIZZNES@nud.n', N'Kierowca', 9, N'adszdArak', 1, N'brak.jpg')
INSERT [dbo].[Pracownik] ([Imie], [Nazwisko], [NrTelefonu], [Email], [Stanowisko], [IdPracownika], [Licencja], [Aktywny], [Zdjecie]) VALUES (N'Morgoth', N'WladcaPiekiel', N'48-158-111-222', N'MORGOTHSILMARIL@nud.n', N'Kierowca', 10, N'badawd1', 1, N'brak.jpg')
SET IDENTITY_INSERT [dbo].[Uzytkownik] ON 

INSERT [dbo].[Uzytkownik] ([IdUzytkownik], [Login], [Haslo], [DataRejestracji], [IdKlient], [IdPracownik]) VALUES (1, N'andrzej', N'50cbe0d972f9b5977ce7bf2652bcf741', CAST(N'2017-06-05 18:37:46.290' AS DateTime), NULL, 2)
INSERT [dbo].[Uzytkownik] ([IdUzytkownik], [Login], [Haslo], [DataRejestracji], [IdKlient], [IdPracownik]) VALUES (2, N'andrzej2', N'50cbe0d972f9b5977ce7bf2652bcf741', CAST(N'2017-06-05 18:38:46.380' AS DateTime), 2, NULL)
INSERT [dbo].[Uzytkownik] ([IdUzytkownik], [Login], [Haslo], [DataRejestracji], [IdKlient], [IdPracownik]) VALUES (4, N'maciej', N'c37976221ab2fefc5578fb38f7003ef9', CAST(N'2017-06-08 00:55:34.990' AS DateTime), 12, NULL)
INSERT [dbo].[Uzytkownik] ([IdUzytkownik], [Login], [Haslo], [DataRejestracji], [IdKlient], [IdPracownik]) VALUES (5, N'piotr', N'99fdb06613cd9b8f328b6cadd98b1c23', CAST(N'2017-06-08 00:59:16.450' AS DateTime), 13, NULL)
INSERT [dbo].[Uzytkownik] ([IdUzytkownik], [Login], [Haslo], [DataRejestracji], [IdKlient], [IdPracownik]) VALUES (6, N'pawel', N'a741cdf4d61e1083064d813a5a1ec8aa', CAST(N'2017-06-08 02:33:09.907' AS DateTime), 14, NULL)
SET IDENTITY_INSERT [dbo].[Uzytkownik] OFF
SET IDENTITY_INSERT [dbo].[Zamowienie] ON 

INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (2, 8, 20, 50.0000, N'dawd', CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), CAST(N'2016-08-09' AS Date), CAST(N'2017-08-09' AS Date), CAST(N'2018-08-09' AS Date), 2)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (4, 10, 20, 50.0000, N'', CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), CAST(N'2016-08-09' AS Date), CAST(N'2017-08-09' AS Date), CAST(N'2018-08-09' AS Date), 2)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (5, 5, 20, 50.0000, N'', CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), CAST(N'2016-08-09' AS Date), CAST(N'2017-08-09' AS Date), CAST(N'2018-08-09' AS Date), 5)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (6, 6, 20, 10.0000, N'', CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), CAST(N'2016-08-09' AS Date), CAST(N'2017-08-09' AS Date), CAST(N'2018-08-09' AS Date), 6)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (9, 14, 20, 15.0000, N'', CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), CAST(N'2016-08-09' AS Date), CAST(N'2017-08-09' AS Date), CAST(N'2018-08-09' AS Date), 1)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (134, 8, 12, 12.0000, N'dwad', CAST(N'2011-08-09' AS Date), CAST(N'2012-08-09' AS Date), CAST(N'2013-08-09' AS Date), CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), 8)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (666, 5, 666, 666.0000, N'Sake', CAST(N'2011-08-09' AS Date), CAST(N'2012-08-09' AS Date), CAST(N'2013-08-09' AS Date), CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), 10)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (667, 13, 23, 1.0000, N'nerwowy klient', CAST(N'2011-08-09' AS Date), CAST(N'2012-08-09' AS Date), CAST(N'2013-08-09' AS Date), CAST(N'2014-08-09' AS Date), CAST(N'2015-08-09' AS Date), 8)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (675, 1, 20, 30.0000, NULL, CAST(N'2017-06-08' AS Date), CAST(N'2018-08-09' AS Date), CAST(N'2014-05-08' AS Date), CAST(N'2018-09-10' AS Date), CAST(N'2012-08-05' AS Date), 2)
INSERT [dbo].[Zamowienie] ([IdZamowienia], [IdKlient], [OdlegloscKM], [Cena], [Uwagi], [DataZlozenia], [DataRealizacji], [TreminRealizacji], [Opoznienie], [DataOdbioruLadunku], [IdSpedytor]) VALUES (679, 12, 20, 150.0000, NULL, CAST(N'2017-06-08' AS Date), NULL, CAST(N'2014-08-06' AS Date), NULL, CAST(N'2014-05-06' AS Date), NULL)
SET IDENTITY_INSERT [dbo].[Zamowienie] OFF
SET ANSI_PADDING ON

GO
/****** Object:  Index [UN_NrVIN]    Script Date: 2017-06-08 22:39:37 ******/
ALTER TABLE [dbo].[Pojazd] ADD  CONSTRAINT [UN_NrVIN] UNIQUE NONCLUSTERED 
(
	[NrVIN] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON

GO
/****** Object:  Index [UN_Pojazd_NrRejestracjyjny]    Script Date: 2017-06-08 22:39:37 ******/
ALTER TABLE [dbo].[Pojazd] ADD  CONSTRAINT [UN_Pojazd_NrRejestracjyjny] UNIQUE NONCLUSTERED 
(
	[NrRejestracyjny] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON

GO
/****** Object:  Index [UN_Pracownik_Licencja]    Script Date: 2017-06-08 22:39:37 ******/
ALTER TABLE [dbo].[Pracownik] ADD  CONSTRAINT [UN_Pracownik_Licencja] UNIQUE NONCLUSTERED 
(
	[Licencja] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_AdresLadunkuDocelowy] FOREIGN KEY([IdAdresDocelowyLadunku])
REFERENCES [dbo].[AdresLadunku] ([IdAdresLadunku])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_AdresLadunkuDocelowy]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_AdresLadunkuStartowy] FOREIGN KEY([IdAdresStartowyLadunku])
REFERENCES [dbo].[AdresLadunku] ([IdAdresLadunku])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_AdresLadunkuStartowy]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_Kategoria] FOREIGN KEY([IdKategoria])
REFERENCES [dbo].[Kategoria] ([IdKategoria])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_Kategoria]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_Kierowca] FOREIGN KEY([IdKierowcy])
REFERENCES [dbo].[Pracownik] ([IdPracownika])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_Kierowca]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_Naczepa] FOREIGN KEY([IdNaczepa])
REFERENCES [dbo].[Naczepa] ([IdNaczepa])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_Naczepa]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_Pojazd] FOREIGN KEY([IdPojazd])
REFERENCES [dbo].[Pojazd] ([IdPojazdu])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_Pojazd]
GO
ALTER TABLE [dbo].[Ladunek]  WITH CHECK ADD  CONSTRAINT [FK_Ladunek_Zamowienie] FOREIGN KEY([IdZamowienia])
REFERENCES [dbo].[Zamowienie] ([IdZamowienia])
GO
ALTER TABLE [dbo].[Ladunek] CHECK CONSTRAINT [FK_Ladunek_Zamowienie]
GO
ALTER TABLE [dbo].[Uzytkownik]  WITH CHECK ADD  CONSTRAINT [FK_Uzytkownik_Klient] FOREIGN KEY([IdKlient])
REFERENCES [dbo].[Klient] ([IdKlient])
GO
ALTER TABLE [dbo].[Uzytkownik] CHECK CONSTRAINT [FK_Uzytkownik_Klient]
GO
ALTER TABLE [dbo].[Uzytkownik]  WITH CHECK ADD  CONSTRAINT [FK_Uzytkownik_Pracownik] FOREIGN KEY([IdPracownik])
REFERENCES [dbo].[Pracownik] ([IdPracownika])
GO
ALTER TABLE [dbo].[Uzytkownik] CHECK CONSTRAINT [FK_Uzytkownik_Pracownik]
GO
ALTER TABLE [dbo].[Zamowienie]  WITH CHECK ADD  CONSTRAINT [FK_Zamowienie_Klient] FOREIGN KEY([IdKlient])
REFERENCES [dbo].[Klient] ([IdKlient])
GO
ALTER TABLE [dbo].[Zamowienie] CHECK CONSTRAINT [FK_Zamowienie_Klient]
GO
ALTER TABLE [dbo].[AdresLadunku]  WITH CHECK ADD  CONSTRAINT [CK_AdresLadunku_KodPocztowy] CHECK  (([KodPocztowy] like '[0-9][0-9]-[0-9][0-9][0-9]'))
GO
ALTER TABLE [dbo].[AdresLadunku] CHECK CONSTRAINT [CK_AdresLadunku_KodPocztowy]
GO
ALTER TABLE [dbo].[Klient]  WITH CHECK ADD  CONSTRAINT [CK_Klient_KodPocztowy] CHECK  (([KodPocztowy] like '[0-9][0-9]-[0-9][0-9][0-9]'))
GO
ALTER TABLE [dbo].[Klient] CHECK CONSTRAINT [CK_Klient_KodPocztowy]
GO
ALTER TABLE [dbo].[Klient]  WITH CHECK ADD  CONSTRAINT [CK_Klient_NrTelefonu] CHECK  (([NrTelefonu] like '[0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9]'))
GO
ALTER TABLE [dbo].[Klient] CHECK CONSTRAINT [CK_Klient_NrTelefonu]
GO
ALTER TABLE [dbo].[Pracownik]  WITH CHECK ADD  CONSTRAINT [CK_Pracownik_NrTelefonu] CHECK  (([NrTelefonu] like '[0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9]'))
GO
ALTER TABLE [dbo].[Pracownik] CHECK CONSTRAINT [CK_Pracownik_NrTelefonu]
GO
ALTER TABLE [dbo].[Zamowienie]  WITH CHECK ADD  CONSTRAINT [CK_Zamowienie_Cena] CHECK  (([Cena]>=(0)))
GO
ALTER TABLE [dbo].[Zamowienie] CHECK CONSTRAINT [CK_Zamowienie_Cena]
GO
/****** Object:  StoredProcedure [dbo].[AdresLadunkuDodaj]    Script Date: 2017-06-08 22:39:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-------------------------
--
-------------------------
-------------------------
-- INSERT'Y
-------------------------


CREATE PROCEDURE [dbo].[AdresLadunkuDodaj]
@P_IdAdresLadunku int, 
@P_Ulica varchar(100), 
@P_Miejscowosc varchar(100), 
@P_KodPocztowy char(6), 
@P_NrDomu varchar(10), 
@P_NrBudynku varchar(10), 
@P_Poczta varchar(100), 
@P_InfoDodatkowe varchar(200), 
@P_NrHangaru varchar(10), 
@P_NrBoxu varchar(10)
AS BEGIN
INSERT dbo.AdresLadunku(IdAdresLadunku, Ulica, Miejscowosc, KodPocztowy, NrDomu, NrBudynku, Poczta, InfoDodatkowe, NrHangaru, NrBoxu)
VALUES
(@P_IdAdresLadunku, 
@P_Ulica, 
@P_Miejscowosc, 
@P_KodPocztowy, 
@P_NrDomu, 
@P_NrBudynku, 
@P_Poczta, 
@P_InfoDodatkowe, 
@P_NrHangaru, 
@P_NrBoxu);
END;

GO
/****** Object:  StoredProcedure [dbo].[AdresLadunkuUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-------------------------
--
-------------------------

-------------------------
-- DELETE'Y
-------------------------
CREATE PROCEDURE [dbo].[AdresLadunkuUsun]
@P_Id int
AS BEGIN
DELETE dbo.AdresLadunku
WHERE IdAdresLadunku=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[AdresLadunkuZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-------------------------
-- 
-------------------------

-------------------------
-- SET'Y
-------------------------
CREATE PROCEDURE [dbo].[AdresLadunkuZmien]
@P_IdAdresLadunku int, 
@P_Ulica varchar(100), 
@P_Miejscowosc varchar(100), 
@P_KodPocztowy char(6), 
@P_NrDomu varchar(10), 
@P_NrBudynku varchar(10), 
@P_Poczta varchar(100), 
@P_InfoDodatkowe varchar(200), 
@P_NrHangaru varchar(10), 
@P_NrBoxu varchar(10)
AS BEGIN
UPDATE dbo.AdresLadunku
SET
Ulica=@P_Ulica, 
Miejscowosc=@P_Miejscowosc, 
KodPocztowy=@P_KodPocztowy, 
NrDomu=@P_NrDomu, 
NrBudynku=@P_NrBudynku, 
Poczta=@P_Poczta, 
InfoDodatkowe=@P_InfoDodatkowe, 
NrHangaru=@P_NrHangaru, 
NrBoxu=@P_NrBoxu
WHERE IdAdresLadunku=@P_IdAdresLadunku
END;

GO
/****** Object:  StoredProcedure [dbo].[KategoriaDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KategoriaDodaj]
@P_IdKategoria int, 
@P_Kategoria varchar(50), 
@P_PodKategoria varchar(50)
AS BEGIN
INSERT dbo.Kategoria(IdKategoria, Kategoria, PodKategoria)
VALUES
(@P_IdKategoria, 
@P_Kategoria, 
@P_PodKategoria);
END;

GO
/****** Object:  StoredProcedure [dbo].[KategoriaUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KategoriaUsun]
@P_Id int
AS BEGIN
DELETE dbo.Kategoria
WHERE IdKategoria=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[KategoriaZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KategoriaZmien]
@P_IdKategoria int, 
@P_Kategoria varchar(50), 
@P_PodKategoria varchar(50)
AS BEGIN
UPDATE dbo.Kategoria
SET
Kategoria=@P_Kategoria, 
PodKategoria=@P_PodKategoria
WHERE IdKategoria=@P_IdKategoria
END;

GO
/****** Object:  StoredProcedure [dbo].[Klient_LiczbaZamowien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------
-----------------------------------------------------------------
---- Wyszukiwanie liczby zamowien w danym przedziale czasowym, o zadanej minimalnej liczbie ow ze zamowien + minimalnej cenie (3)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[Klient_LiczbaZamowien]
@Par_DataOd date = '1900-01-01',
@Par_DataDo date = '2100-12-31',
@Par_MinLiczba int = 0,
@Par_MinSrednia money =0
AS
BEGIN
SELECT dbo.Klient.IdKlient, Imie, Miejscowosc, NIP, COUNT(*) AS [Liczba zamowien], SUM(Cena) AS [Kwota Laczna wszystkich zamowien]
FROM dbo.Klient
	INNER JOIN dbo.Zamowienie
	ON dbo.Klient.IdKlient = dbo.Zamowienie.IdKlient
WHERE DataZlozenia BETWEEN @Par_DataOd AND @Par_DataDo
GROUP BY dbo.Klient.IdKlient, Imie, Miejscowosc, NIP
HAVING COUNT(*) >= @Par_MinLiczba AND SUM(Cena) >= @Par_MinSrednia
ORDER BY [Kwota Laczna wszystkich zamowien] DESC, [Liczba zamowien] DESC;
END;

GO
/****** Object:  StoredProcedure [dbo].[KlientDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KlientDodaj]
@P_IdKlient int,
 @P_Imie varchar(50), 
 @P_Ulica varchar(100), 
 @P_Miejscowosc varchar(100), 
 @P_NrDomu varchar(10), 
 @P_NrBudynku varchar(10), 
 @P_KodPocztowy char(6), 
 @P_Poczta varchar(100), 
 @P_NrTelefonu varchar(20), 
 @P_Email varchar(100), 
 @P_Pesel int, 
 @P_Nip int, 
 @P_Regon int, 
 @P_Fax varchar(50)
 AS BEGIN
 INSERT dbo.Klient (IdKlient, Imie, Ulica, Miejscowosc, NrDomu, NrBudynku, KodPocztowy, Poczta, NrTelefonu, Email, Pesel, Nip, Regon, Fax)
 VALUES
 (@P_IdKlient,
 @P_Imie, 
 @P_Ulica, 
 @P_Miejscowosc, 
 @P_NrDomu, 
 @P_NrBudynku, 
 @P_KodPocztowy, 
 @P_Poczta, 
 @P_NrTelefonu, 
 @P_Email, 
 @P_Pesel, 
 @P_Nip, 
 @P_Regon, 
 @P_Fax);
 END;

GO
/****** Object:  StoredProcedure [dbo].[KlientUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KlientUsun]
@P_Id int
AS BEGIN
DELETE dbo.Klient
WHERE IdKlient=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[KlientZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[KlientZmien]
@P_IdKlient int,
 @P_Imie varchar(50), 
 @P_Ulica varchar(100), 
 @P_Miejscowosc varchar(100), 
 @P_NrDomu varchar(10), 
 @P_NrBudynku varchar(10), 
 @P_KodPocztowy char(6), 
 @P_Poczta varchar(100), 
 @P_NrTelefonu varchar(20), 
 @P_Email varchar(100), 
 @P_Pesel int, 
 @P_Nip int, 
 @P_Regon int, 
 @P_Fax varchar(50)
 AS BEGIN
 UPDATE dbo.Klient
 SET
 Imie=@P_Imie, 
 Ulica=@P_Ulica, 
 Miejscowosc=@P_Miejscowosc, 
 NrDomu =@P_NrDomu, 
 NrBudynku=@P_NrBudynku, 
 KodPocztowy=@P_KodPocztowy, 
 Poczta=@P_Poczta, 
 NrTelefonu=@P_NrTelefonu, 
 Email=@P_Email, 
 Pesel=@P_Pesel, 
 Nip=@P_Nip, 
 Regon=@P_Regon, 
 Fax=@P_Fax
 WHERE IdKlient=@P_IdKlient
 END;

GO
/****** Object:  StoredProcedure [dbo].[KlientZnajdzImie]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------
-----------------------------------------------------------------
---- Wyszukiwanie klientow po zadanej frazie (przyrownujac fraze do imienia) (2)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[KlientZnajdzImie]
@Par_Imie varchar(50) = ''
AS 
BEGIN
SELECT Imie, Ulica, Miejscowosc, NrDomu, NrBudynku, KodPocztowy, Poczta, NrTelefonu, Email, Pesel, Nip, Regon, Fax
FROM dbo.Klient
WHERE Imie LIKE '%' + LTRIM(RTRIM(@Par_Imie)) + '%'
ORDER BY Imie ASC;
END;

GO
/****** Object:  StoredProcedure [dbo].[Ladunek_LiczbaKursowWDaneMiejsce]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------
-----------------------------------------------------------------
---- Wyszukiwanie kursow rownej / powyzej zadanej wartosci powtorzen  (4)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[Ladunek_LiczbaKursowWDaneMiejsce]
@Par_MinLiczba int = 0
AS
BEGIN
SELECT  dbo.AdresLadunku.Miejscowosc, COUNT(*) AS [Liczba zamowien]
FROM dbo.Ladunek
	INNER JOIN dbo.AdresLadunku
	ON dbo.Ladunek.IdAdresDocelowyLadunku = dbo.AdresLadunku.IdAdresLadunku
GROUP BY dbo.AdresLadunku.Miejscowosc 
HAVING COUNT(*) >= @Par_MinLiczba
ORDER BY [Liczba zamowien] DESC;
END;

GO
/****** Object:  StoredProcedure [dbo].[LadunekDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[LadunekDodaj]
@P_IdLadunek int, 
@P_IdZamowienia int, 
@P_RodzajLadunku varchar(50), 
@P_MasaLadunkuKG int, 
@P_LiczbaSztukLadunku int, 
@P_IdAdresStartowyLadunku int, 
@P_IdAdresDocelowyLadunku int, 
@P_IdKategoria int, 
@P_IdPojazd int, 
@P_IdNaczepa int, 
@P_IdKierowcy int, 
@P_UszkodzeniaWProc int, 
@P_Podliczone int
AS BEGIN
INSERT dbo.Ladunek (IdLadunek, IdZamowienia, RodzajLadunku, MasaLadunkuKG, LiczbaSztukLadunku, IdAdresStartowyLadunku, IdAdresDocelowyLadunku, IdKategoria, IdPojazd, IdNaczepa, IdKierowcy, UszkodzeniaWProc, Podliczone)
VALUES
(@P_IdLadunek, 
@P_IdZamowienia, 
@P_RodzajLadunku, 
@P_MasaLadunkuKG, 
@P_LiczbaSztukLadunku, 
@P_IdAdresStartowyLadunku, 
@P_IdAdresDocelowyLadunku, 
@P_IdKategoria, 
@P_IdPojazd, 
@P_IdNaczepa, 
@P_IdKierowcy, 
@P_UszkodzeniaWProc, 
@P_Podliczone);
END;

GO
/****** Object:  StoredProcedure [dbo].[LadunekUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[LadunekUsun]
@P_Id int
AS BEGIN
DELETE dbo.Ladunek
WHERE IdLadunek=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[LadunekZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[LadunekZmien]
@P_IdLadunek int, 
@P_IdZamowienia int, 
@P_RodzajLadunku varchar(50), 
@P_MasaLadunkuKG int, 
@P_LiczbaSztukLadunku int, 
@P_IdAdresStartowyLadunku int, 
@P_IdAdresDocelowyLadunku int, 
@P_IdKategoria int, 
@P_IdPojazd int, 
@P_IdNaczepa int, 
@P_IdKierowcy int, 
@P_UszkodzeniaWProc int, 
@P_Podliczone int
AS BEGIN
UPDATE dbo.Ladunek
SET
IdZamowienia=@P_IdZamowienia, 
RodzajLadunku=@P_RodzajLadunku, 
MasaLadunkuKG=@P_MasaLadunkuKG, 
LiczbaSztukLadunku=@P_LiczbaSztukLadunku, 
IdAdresStartowyLadunku=@P_IdAdresStartowyLadunku, 
IdAdresDocelowyLadunku=@P_IdAdresDocelowyLadunku, 
IdKategoria=@P_IdKategoria, 
IdPojazd=@P_IdPojazd, 
IdNaczepa=@P_IdNaczepa, 
IdKierowcy=@P_IdKierowcy, 
UszkodzeniaWProc=@P_UszkodzeniaWProc, 
Podliczone=@P_Podliczone
WHERE IdLadunek=@P_IdLadunek
END;

GO
/****** Object:  StoredProcedure [dbo].[NaczepaDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[NaczepaDodaj]
@P_IdNaczepa int, 
@P_NazwaNaczepa varchar(50), 
@P_RodzajNaczepa varchar(50)
AS BEGIN
INSERT dbo.Naczepa(IdNaczepa, NazwaNaczepa, RodzajNaczepa)
VALUES
(@P_IdNaczepa, 
@P_NazwaNaczepa, 
@P_RodzajNaczepa);
END;

GO
/****** Object:  StoredProcedure [dbo].[NaczepaUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[NaczepaUsun]
@P_Id int
AS BEGIN
DELETE dbo.Naczepa
WHERE IdNaczepa=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[NaczepaWolna]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[NaczepaWolna]
AS
BEGIN
SELECT dbo.Naczepa.IdNaczepa, NazwaNaczepa, RodzajNaczepa
FROM dbo.Naczepa
INNER JOIN dbo.Ladunek
	ON dbo.Naczepa.IdNaczepa = dbo.Ladunek.IdNaczepa
ORDER BY dbo.Naczepa.IdNaczepa DESC;
END;

GO
/****** Object:  StoredProcedure [dbo].[NaczepaWUzyciu]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------
-----------------------------------------------------------------
---- Wyszukiwanie naczep, ktore sa juz w uzytku  (tj. sa podpiete do danego ladunku) (6)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[NaczepaWUzyciu]
AS
BEGIN
SELECT dbo.Naczepa.IdNaczepa, NazwaNaczepa, RodzajNaczepa
FROM dbo.Naczepa
INNER JOIN dbo.Ladunek
	ON dbo.Ladunek.IdNaczepa = dbo.Naczepa.IdNaczepa
ORDER BY dbo.Naczepa.IdNaczepa DESC;
END;

GO
/****** Object:  StoredProcedure [dbo].[NaczepaZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[NaczepaZmien]
@P_IdNaczepa int, 
@P_NazwaNaczepa varchar(50), 
@P_RodzajNaczepa varchar(50)
AS BEGIN
UPDATE dbo.Naczepa
SET 
NazwaNaczepa=@P_NazwaNaczepa, 
RodzajNaczepa=@P_RodzajNaczepa
WHERE IdNaczepa=@P_IdNaczepa
END;

GO
/****** Object:  StoredProcedure [dbo].[Obliczanie_Ceny]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[Obliczanie_Ceny]
@Par_IdZamowienia int
AS
BEGIN
SET XACT_ABORT ON;

BEGIN TRANSACTION
DECLARE @Var_Masa int, @Var_Rodzaj varchar(50), @Var_Cena int =0, @Var_Podliczone int, @Var_Id int, @Var_flaga int =0;
SELECT @Var_Masa = MasaLadunkuKG, @Var_Rodzaj = RodzajLadunku, @Var_Podliczone = Podliczone, @Var_Id=IdLadunek
FROM dbo.Ladunek
WHERE IdZamowienia = @Par_IdZamowienia;
SET @Var_Cena+= @Var_Masa*2+@Var_Id;

-- (2) Update ceny dla zamowienia na podstawie masy ladunku // rodzaju jeszcze nie.


IF(@Var_Podliczone  LIKE 0)
BEGIN

	UPDATE dbo.Zamowienie 
SET Cena +=@Var_Cena
WHERE IdZamowienia = @Par_IdZamowienia;

UPDATE dbo.Ladunek 
SET Podliczone = 1
WHERE IdZamowienia = @Par_IdZamowienia;

END
ELSE
	RAISERROR('Podliczenie ceny nie powiodlo sie, poniewaz zostala juz ona podliczona z ladunku o podanym ID',16,1);




IF(@@ERROR <> 0)
BEGIN
	--RAISERROR('Archiwizacja nie powiodla sie',16,1);
	ROLLBACK TRANSACTION

END
ELSE
	COMMIT TRANSACTION



END;

GO
/****** Object:  StoredProcedure [dbo].[PojazdDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PojazdDodaj]
@P_IdPojazdu int, 
@P_NazwaPojazdu varchar(50),
@P_NrRejestracyjny char(10), 
@P_NrVIN char(30), 
@P_MarkaPojazdu varchar(30), 
@P_Model varchar(30), 
@P_RokProdukcji date
AS BEGIN
INSERT dbo.Pojazd(IdPojazdu, NazwaPojazdu, NrRejestracyjny, NrVIN, MarkaPojazdu, Model, RokProdukcji)
VALUES
(@P_IdPojazdu, 
@P_NazwaPojazdu,
@P_NrRejestracyjny, 
@P_NrVIN, 
@P_MarkaPojazdu, 
@P_Model, 
@P_RokProdukcji);
END;

GO
/****** Object:  StoredProcedure [dbo].[PojazdMarki]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------
-----------------------------------------------------------------
---- Wyszukiwanie pojazdow danej marki (5)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[PojazdMarki]
@Par_Marka varchar(50)
AS
BEGIN
SELECT NrRejestracyjny,NrVIN,NazwaPojazdu, MarkaPojazdu, Model, RokProdukcji
FROM dbo.Pojazd
WHERE MarkaPojazdu LIKE @Par_Marka
ORDER BY NrRejestracyjny ASC;
END;

GO
/****** Object:  StoredProcedure [dbo].[PojazdUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PojazdUsun]
@P_Id int
AS BEGIN
DELETE dbo.Pojazd
WHERE IdPojazdu=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[PojazdZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PojazdZmien]
@P_IdPojazdu int, 
@P_NazwaPojazdu varchar(50),
@P_NrRejestracyjny char(10), 
@P_NrVIN char(30), 
@P_MarkaPojazdu varchar(30), 
@P_Model varchar(30), 
@P_RokProdukcji date
AS BEGIN
UPDATE dbo.Pojazd
SET 
NazwaPojazdu=@P_NazwaPojazdu,
NrRejestracyjny=@P_NrRejestracyjny, 
NrVIN=@P_NrVIN, 
MarkaPojazdu=@P_MarkaPojazdu, 
Model=@P_Model, 
RokProdukcji=@P_RokProdukcji
WHERE IdPojazdu=@P_IdPojazdu
END;

GO
/****** Object:  StoredProcedure [dbo].[Pracownik_Archiwizacja]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[Pracownik_Archiwizacja]
@Par_IdPracownika int
AS
BEGIN
--  Ustawienie przerywania bloku transakcji przy wystapieniu bledu czasu wykonania (ang. runtime error).
SET XACT_ABORT ON;

BEGIN TRANSACTION
-- (1) Skopiowanei danych klienta do archiwum.
INSERT dbo.Pracownik_Archiwum
(Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja)
SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja
FROM dbo.Pracownik
WHERE IdPracownika = @Par_IdPracownika;

-- (2) Oznaczanie pracownika jako nieaktywny.
UPDATE dbo.Pracownik
SET Aktywny=0
WHERE IdPracownika = @Par_IdPracownika;



IF(@@ERROR <> 0)
BEGIN
	RAISERROR('Archiwizacja nie powiodla sie',16,1);
	ROLLBACK TRANSACTION

END
ELSE
	COMMIT TRANSACTION



END;

GO
/****** Object:  StoredProcedure [dbo].[PracownikDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PracownikDodaj]
@P_Imie varchar(50), 
@P_Nazwisko varchar(100), 
@P_NrTelefonu varchar(20), 
@P_Email varchar(100), 
@P_Stanowisko varchar(50), 
@P_IdPracownika int, 
@P_Licencja varchar(50), 
@P_Aktywny int, 
@P_Zdjecie varchar(50)
AS BEGIN
INSERT dbo.Pracownik(Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja, Aktywny, Zdjecie)
VALUES
(@P_Imie, 
@P_Nazwisko, 
@P_NrTelefonu, 
@P_Email, 
@P_Stanowisko, 
@P_IdPracownika, 
@P_Licencja, 
@P_Aktywny, 
@P_Zdjecie);
END;

GO
/****** Object:  StoredProcedure [dbo].[PracownikUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PracownikUsun]
@P_Id int
AS BEGIN
DELETE dbo.Pracownik
WHERE IdPracownika=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[PracownikZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[PracownikZmien]
@P_Imie varchar(50), 
@P_Nazwisko varchar(100), 
@P_NrTelefonu varchar(20), 
@P_Email varchar(100), 
@P_Stanowisko varchar(50), 
@P_IdPracownika int, 
@P_Licencja varchar(50), 
@P_Aktywny int, 
@P_Zdjecie varchar(50)
AS BEGIN
UPDATE dbo.Pracownik
SET
Imie=@P_Imie, 
Nazwisko=@P_Nazwisko, 
NrTelefonu=@P_NrTelefonu, 
Email=@P_Email, 
Stanowisko=@P_Stanowisko, 
Licencja=@P_Licencja, 
Aktywny=@P_Aktywny, 
Zdjecie=@P_Zdjecie
WHERE IdPracownika=@P_IdPracownika
END;

GO
/****** Object:  StoredProcedure [dbo].[ZamowienieDodaj]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--CREATE PROCEDURE dbo.Pracownik_ArchiwumDodaj

CREATE PROCEDURE [dbo].[ZamowienieDodaj]
@P_IdZamowienia int, 
@P_IdKlient int, 
@P_OdlegloscKM int, 
@P_Cena money, 
@P_Uwagi varchar(200), 
@P_DataZlozenia date, 
@P_DataRealizacji date, 
@P_TreminRealizacji date, 
@P_Opoznienie date, 
@P_DataOdbioruLadunku date, 
@P_IdSpedytor int
AS BEGIN
INSERT dbo.Zamowienie(IdZamowienia, IdKlient, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, IdSpedytor)
VALUES
(@P_IdZamowienia, 
@P_IdKlient, 
@P_OdlegloscKM, 
@P_Cena, 
@P_Uwagi, 
@P_DataZlozenia, 
@P_DataRealizacji, 
@P_TreminRealizacji, 
@P_Opoznienie, 
@P_DataOdbioruLadunku, 
@P_IdSpedytor);
END;

GO
/****** Object:  StoredProcedure [dbo].[ZamowienieUsun]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--CREATE PROCEDURE dbo.Pracownik_ArchiwumUsun

CREATE PROCEDURE [dbo].[ZamowienieUsun]
@P_Id int
AS BEGIN
DELETE dbo.Zamowienie
WHERE IdZamowienia=@P_Id
END;

GO
/****** Object:  StoredProcedure [dbo].[ZamowienieZmien]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--CREATE PROCEDURE dbo.Pracownik_ArchiwumDodaj

CREATE PROCEDURE [dbo].[ZamowienieZmien]
@P_IdZamowienia int, 
@P_IdKlient int, 
@P_OdlegloscKM int, 
@P_Cena money, 
@P_Uwagi varchar(200), 
@P_DataZlozenia date, 
@P_DataRealizacji date, 
@P_TreminRealizacji date, 
@P_Opoznienie date, 
@P_DataOdbioruLadunku date, 
@P_IdSpedytor int
AS BEGIN
UPDATE dbo.Zamowienie
SET
IdKlient=@P_IdKlient, 
OdlegloscKM=@P_OdlegloscKM, 
Cena=@P_Cena, 
Uwagi=@P_Uwagi, 
DataZlozenia=@P_DataZlozenia, 
DataRealizacji=@P_DataRealizacji, 
TreminRealizacji=@P_TreminRealizacji, 
Opoznienie=@P_Opoznienie, 
DataOdbioruLadunku=@P_DataOdbioruLadunku, 
IdSpedytor=@P_IdSpedytor
WHERE IdZamowienia=@P_IdZamowienia 
END;

GO
/****** Object:  StoredProcedure [dbo].[ZamowienieZnajdzCena]    Script Date: 2017-06-08 22:39:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-----------------------------------------------------------------
---- Wyszukiwanie zamowien w ktorych cena laczna znajduje sie w zadanym przedziale + wyswietlenie "topki" z wybranego przedzialu (1)
-----------------------------------------------------------------
CREATE PROCEDURE [dbo].[ZamowienieZnajdzCena]
@Par_CenaOd money = 0.00,
@Par_CenaDo money = 100000000,
@Par_Top int = 100000
AS BEGIN
SELECT  TOP (@Par_Top) IdZamowienia, IdKlient, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, IdSpedytor
FROM dbo.Zamowienie
WHERE Cena BETWEEN @Par_CenaOd AND @Par_CenaDo
ORDER BY Cena DESC, IdZamowienia DESC;
END;

GO
