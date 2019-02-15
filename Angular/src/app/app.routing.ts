import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegisterComponent } from './user/register/register.component';
import { LoginComponent } from './user/login/login.component';

import { AddGameComponent } from './admin/addgame/addgame.component';
import { AddRestComponent } from './admin/addrest/addrest.component';

import { GamesComponent } from './game/games.component';
import { GameComponent } from './game/profile/game.component';
import { GenreGamesComponent } from './game/genregames/genregames.component';
import { HomeComponent } from './site/home/home.component';
import { AboutUsComponent } from './site/aboutus/aboutus.component';
import { ContactComponent } from './site/contact/contact.component';
import { TermsComponent } from './site/terms/terms.component';
import { CartComponent } from './user/cart/cart.component';
import { WishlistComponent } from './user/wishlist/wishlist.component';

import {UserComponent} from "./user/user.component";
import {UserGamesComponent} from "./user/usergames/usergames.component";
import {AdminComponent} from "./admin/admin.component";

const appRoutes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'aboutus', component: AboutUsComponent},
  { path: 'contact', component: ContactComponent},
  { path: 'terms', component: TermsComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'login', component: LoginComponent},
  { path: 'addgame', component: AddGameComponent},
  { path: 'allgames', component: GamesComponent},
  { path: 'addrest', component: AddRestComponent},
  { path: 'game/:id', component: GameComponent},
  { path: 'genregames/:id', component: GenreGamesComponent},
  { path: 'cart', component: CartComponent},
  { path: 'wishlist', component: WishlistComponent},
  { path: 'user', component: UserComponent},
  { path: 'usergames', component: UserGamesComponent},
  { path: 'admin', component: AdminComponent}
];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
