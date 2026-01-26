import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserService, User } from '../../services/user.service';
import { RouterModule } from '@angular/router';
import { Observable } from 'rxjs';
import { UserModalComponent } from '../user-modal/user-modal';

@Component({
  selector: 'app-user-list',
  standalone: true,
  imports: [CommonModule, RouterModule, UserModalComponent],
  templateUrl: './user-list.html',
  styleUrls: ['./user-list.scss']
})
export class UserListComponent implements OnInit {

  users$!: Observable<User[]>;
  users: User[] = [];

  isModalOpen = false;

  constructor(private userService: UserService) {}

  ngOnInit(): void {
    this.users$ = this.userService.getUsers();
  }

  delete(id: number): void {
    if (!confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
      return;
    }

    this.userService.deleteUser(id).subscribe(() => {
      this.users = this.users.filter(user => user.id !== id);
    });
  }

  openModal(): void {
    this.isModalOpen = true;
  }

  closeModal(): void {
    this.isModalOpen = false;
  }

    onUserAdded(): void {
    this.users$ = this.userService.getUsers();
    this.closeModal();
  }
}
